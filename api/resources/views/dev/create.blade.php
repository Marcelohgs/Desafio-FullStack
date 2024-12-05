@extends('layout.app')

@section('content')
    <div class="container mt-5">

        <h1 class="mb-4">
            {{ $id === 0 ? 'Cadastro de Desenvolvedor' : 'Editando Desenvolvedor - ' . $dev->nome }}
        </h1>

        <form id="Form-create-dev" action="#">
            @csrf
            @if($id !== 0) @method('PUT') @endif

                        <!-- ID (Exibido, não editável) -->
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="number" class="form-control" id="id" name="id" value="{{ old('id', $id) }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nivel_id" class="form-label">Nível</label>
                            <select class="form-select" id="nivel_id" name="nivel_id">
                                @foreach($niveis as $nivel)
                                    <option value="{{ $nivel->id }}"
                                        {{ isset($nivelSelecionado) && $nivel->id == $nivelSelecionado ? 'selected' : '' }}>
                                        {{ $nivel->nivel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ isset($dev->nome) ?  $dev->nome : '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select class="form-select" id="sexo" name="sexo">
                                <option value="M" {{isset($dev->sexo) && old('sexo', $dev->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{isset($dev->sexo) && old('sexo', $dev->sexo) == 'F' ? 'selected' : '' }}>Feminino</option>
                                <option value="O" {{isset($dev->sexo) && old('sexo', $dev->sexo) == 'O' ? 'selected' : '' }}>Outro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"
                                   value="{{ isset($dev->data_nascimento) ? \Carbon\Carbon::parse($dev->data_nascimento)->format('Y-m-d') : '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="hobby" class="form-label">Hobby</label>
                            <input type="text" class="form-control" id="hobby" name="hobby" value="{{isset($dev->hobby) ? $dev->hobby : '' }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn-save-dev">
                            {{ $id === 0 ? 'Salvar' : 'Salvar Alterações' }}
                        </button>

                        <a class="btn btn-danger" href="{{ route('app.dev') }}">Voltar</a>
                    </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            // Função genérica para salvar ou editar desenvolvedor
            function saveOrEditDev(method, id = null) {
                var data = {
                    nivel_id: $('#nivel_id').val(),
                    nome: $('#nome').val(),
                    sexo: $('#sexo').val(),
                    data_nascimento: $('#data_nascimento').val(),
                    hobby: $('#hobby').val()
                };

                var url = method === 'POST' ? '/api/v1/desenvolvedores' : '/api/v1/desenvolvedores/' + id;
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (data, textStatus, jqXHR) {
                        if (jqXHR.status === 200 || jqXHR.status === 201) {
                            successMsg('Desenvolvedor salvo com sucesso!');
                        } else {
                            errorMsg('Erro ao salvar Desenvolvedor! ' + jqXHR.responseText);
                        }
                        setTimeout(() => {
                            window.location.href = "/dev";
                        }, "1000");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        try {
                            var response = JSON.parse(jqXHR.responseText);
                            errorMsg(response.message);
                        } catch (e) {
                            errorMsg('Erro desconhecido');
                        }
                    }
                });
            }

            $('#Form-create-dev').on('submit', function(event) {
                event.preventDefault();
                var method = $('#id').val() == 0 ? 'POST' : 'PUT'; // Definir o método (POST ou PUT)
                var id = $('#id').val(); // Para PUT, pegar o ID
                saveOrEditDev(method, id);  // Chama a função de salvar ou editar
            });
        });
    </script>

@endsection
