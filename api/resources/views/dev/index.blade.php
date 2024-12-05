@extends('layout.app')

@section('content')
<body class="antialiased">
<div class="container mt-5">
    <h1 class="mb-4">Lista de Desenvolvedores Cadastrados</h1>
    <table id="myTable" class="display table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Nível</th>
            <th>Ações</th>
        </tr>
        </thead>
    </table>
    <hr>
    <div>
        <a href="/dev/cadastrar" class="btn btn-primary">Cadastrar Novo Desenvolvedor</a>
    </div>
</div>

<!-- Inicialização do DataTable -->
<script>
    var table_dev =  $('#myTable').DataTable({
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
            { width: '20%', targets: 2, },
            { width: '20%', targets: 3, },
        ],
        ajax: {
            url: '/api/v1/desenvolvedores',
            dataSrc: 'data',
            error: function (jqXHR, textStatus, errorThrown) {
                var response = JSON.parse(jqXHR.responseText)
                errorMsg(response.message)
            }
        },
        columns: [
            { data: 'id' },
            { data: 'nome' },
            { data: 'nivel.nivel' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-primary btn-sm" onclick="editDev(${row.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteDev(${row.id})">Excluir</button>
                    `;
                }
            }
        ]
    });

    // Função para editar
    function editDev(id) {
        window.location.href = '/dev/editar/'+id
    }

    // Função  para deletar
    function deleteDev(id) {
        var deletar = confirm('Deseja deletar este Desenvolvedor?')

        if(deletar){
            $.ajax({
                url: "/api/v1/desenvolvedores/"+id,
                method: 'DELETE',
                success: function (data, textStatus, jqXHR) {
                    if (jqXHR.status === 204){
                        successMsg("Desenvolvedor excluído com sucesso!");
                    }
                    else{
                        errorMsg('Erro ao excluir desenvolvedor! '+jqXHR.responseText);
                    }
                  table_dev.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    var response = JSON.parse(jqXHR.responseText)
                    errorMsg(response.message);
                }
            });
        }

    }
</script>
</body>
@endsection
