@extends('layout.app')

@section('content')
    <body class="antialiased">

    <div class="container mt-5">

        <h1 class="mb-4">Lista de Níveis Cadastrados</h1>
        <table id="myTable" class="display table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Desenvolvedores Associados</th>
                <th>Ações</th>
            </tr>
            </thead>
        </table>
        <hr>
        <div>
            <a href="/nivel/cadastrar" class="btn btn-primary">Cadastrar Novo Nível</a>
        </div>
    </div>

    <!-- Inicialização do DataTable -->
    <script>
        $table = $('#myTable').DataTable({
            language: {
                "url": "/js/lang/data-table-portugues-brasil.json"
            },
            stateSave: true,
            responsive: true,
            colReorder: true,
            processing: true,
            serverSide: false,
            columnDefs: [
                { width: '10%', targets: 0, },
                { width: '30%', targets: 1, },
                { width: '30%', targets: 2, },
            ],
            ajax: {
                url: '/api/v1/niveis',
                dataSrc: 'data',
                error: function (jqXHR, textStatus, errorThrown) {
                    var response = JSON.parse(jqXHR.responseText)
                    errorMsg(response.message);
                }
            },
            columns: [
                { data: 'id' },
                { data: 'nivel' },
                { data: 'qtd_devs' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                        <button class="btn btn-primary btn-sm" onclick="editNivel(${row.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteNivel(${row.id})">Excluir</button>
                    `;
                    }
                }
            ]
        });

        function editNivel(id) {
            window.location.href = '/nivel/editar/'+id
        }

        function deleteNivel(id) {
            var deletar = confirm('Deseja deletar este Nível?')

            if(deletar){
                $.ajax({
                    url: "/api/v1/nivel/" + id,
                    method: 'DELETE',
                    success: function (data, textStatus, jqXHR) {
                        if (jqXHR.status === 204){
                            successMsg("Nível excluído com sucesso!");
                         }
                        else{
                            errorMsg("Erro ao excluir nível!" +jqXHR.responseText);
                        }
                        $table.ajax.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var response = JSON.parse(jqXHR.responseText);
                        errorMsg(response.message);
                    }
                });
            }
        }

    </script>
    </body>
@endsection
