<?php

// CARREGANDO SCRIPTS DE CONEXÃO E CONFIGURAÇÃO DO SISTEMA ( BANCO DE DADOS )
require_once("../config/config.php");
require_once("../config/conexao.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hopistal-SYS</title>
    <link rel="stylesheet" href="css/painel.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-content">

                <div class="content-img">
                    <a class="navbar-brand" href="#">
                        <img src="#"> <!-- LOGO -->
                    </a>
                </div>

                <div class="content-dropdown">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> NOME
                                    <?php //echo $_SESSION['nome_usuario']; ?>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../logout.php">Sair</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#modal">Alterar Senha</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">

            <div class="col-md-3 col-sm-12 mb-4">

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link menu-link home-link" href="home.php" id="v-pills-home-tab" role="tab"
                        aria-controls="v-pills-home" aria-selected="true">
                        <i class="fas fa-home mr-1"></i>Home
                    </a>

                    <a class="nav-link menu-link paciente-link" href="paciente.php" id="v-pills-paciente-tab" role="tab"
                        aria-controls="v-pills-paciente" aria-selected="true">
                        <i class="fas fa-home mr-1"></i>Cadastrar Pacientes
                    </a>


                </div>
            </div>

            <div class="col-md-9 col-sm-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div id="conteudo-dinamico">
                            <script src="js/ajax.js"></script>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</body>