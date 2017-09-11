<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>MAPIOSRV - Servidor de Mapas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/css/custom.css">



    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo BASEURL; ?>index.php" class="navbar-brand" style="font-weight: bold;"> MAPIOSRV&nbsp;</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse center-block">
          <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="<?php echo BASEURL; ?>mapserver" class="dropdown-toggle"  role="button" aria-expanded="false">
                    Visualizar Mapas
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Projetos <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>projetos">Gerenciar Projetos</a></li>
                    <li><a href="<?php echo BASEURL; ?>projetos/add.php">Novo Projeto</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Clientes <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>clientes">Gerenciar Clientes</a></li>
                    <li><a href="<?php echo BASEURL; ?>clientes/add.php">Novo Cliente</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Camadas <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>camadas">Gerenciar Camadas</a></li>
                    <li><a href="<?php echo BASEURL; ?>camadas/add.php">Nova Camada</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Agrupadores <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo BASEURL; ?>agrpd">Gerenciar Agrupadores</a></li>
                    <li><a href="<?php echo BASEURL; ?>agrpd/add.php">Novo Agrupador</a></li>
                </ul>
            </li>
          </ul>

          <img src="/imagens/mpobc_semfundo.png" class="float-right center-block" alt="logo_mapio">

        </div><!--/.navbar-collapse -->

        </div>
      </div>
    </nav>

    <main class="container-fluid">
