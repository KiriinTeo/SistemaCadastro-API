<?php include_once("cabec.php");  ?>

<p>&nbsp;</p>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <h2 align="center" class="text-dark">Cadastros Realizados</h2>

    <div class="container">
        <table id="dados" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Senha</th>
                </tr>
            </thead>
            <tbody>
                <!-- aqui vai os dados da API -->
            </tbody>
        </table>
    </div>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>

        document.addEventListener("DOMContentLoaded", function() {

            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');

            fetch("http://localhost/api_login/exibirApi.php") 
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro ao acessar a API");
                    }
                    return response.json(); 
                })
                .then(data => {
                    if (data.status === 'success') {
                        const tabela = document.querySelector("#dados tbody");
                        tabela.innerHTML = "";

                        data.data.forEach(usuario => {
                            const row = `
                                <tr>
                                    <td>${usuario.id}</td>
                                    <td>${usuario.email}</td>
                                    <td>${usuario.senha}</td>
                                </tr>
                            `;
                            tabela.innerHTML += row; 
                        });
                        
                        const tabelaData = $('#dados').DataTable();

                        // Preencher o campo de busca automaticamente com o email da URL
                        if (email) {
                            tabelaData.search(email).draw(); // Inserir e executar a busca
                        }

                    } else {
                        alert("Erro ao carregar os dados: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Erro ao consumir a API:", error);
                    alert("Erro ao carregar os dados. Veja o console para mais detalhes.");
                });
        });
    </script>
</body>
</html>
