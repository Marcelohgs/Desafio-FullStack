@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <form id="Form-create" action="#">
            <h1 class="mb-4">
                {{ $id === 0 ? 'Cadastro de Nível' : 'Editando Nível - ' . $nivel->nome }}
            </h1>

            <!-- ID (Exibido, não editável) -->
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" name="id" value="{{ old('id', $id) }}" readonly>
            </div>

            <!-- Nome -->
            <div class="mb-3">
                <label for="nivel" class="form-label">Nível</label>
                <input type="text" class="form-control" id="nivel" name="nivel" value="{{ $nivel->nivel ?? '' }}">
            </div>

            <!-- Botão de salvar -->
            <button type="submit" class="btn btn-primary" id="btn-save-nivel">
                {{ $id === 0 ? 'Salvar' : 'Salvar Alterações' }}
            </button>

            <!-- Botão voltar -->
            <a class="btn btn-danger" href="{{ route('app.nivel') }}">Voltar</a>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            // Função genérica para salvar ou editar nível
            function saveOrEditNivel(method, id = null) {
                var data = {
                    nivel: $('#nivel').val()
                };

                var url = method === 'POST' ? '/api/v1/niveis' : '/api/v1/niveis/' + id;
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (data, textStatus, jqXHR) {
                        if (jqXHR.status === 200 || jqXHR.status === 201) {
                            alert('Nível salvo com sucesso!');
                        } else {
                            alert('Erro ao salvar nível! ' + jqXHR.responseText);
                        }
                        window.location.href = "/nivel";
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        try {
                            var response = JSON.parse(jqXHR.responseText);
                            alert(response.message);
                        } catch (e) {
                            alert('Erro desconhecido');
                        }
                    }
                });
            }

            $('#Form-create').on('submit', function(event) {
                event.preventDefault();
                var method = $('#id').val() == 0 ? 'POST' : 'PUT'; // Definir o método (POST ou PUT)
                var id = $('#id').val(); // Para PUT, pegar o ID
                saveOrEditNivel(method, id);
            });
        });
    </script>
@endsection
