<?php
require_once('config.php');
?>

<?php include(HEADER_TEMPLATE); ?>

<BR>
<!-- Divisão principal da página (JUMBOTRON) -->
<div class="jumbotron">
  <div class="container">
    <h1 class="display-3">Bem Vindo ao MAPIOSRV&nbsp;<i class="fa fa-map" aria-hidden="true"></i></h1>
    <p>Este é o servidor de mapas da Mapio Geotech Engenharia. Aqui você irá encontrar todos os mapas e informações geolocalizadas de nossa base de dados. Caso tenha alguma dúvida ou problema de utilização, procure nossa equipe ou mande email para: contato@mapio.com.br.</p>
    <p><a class="btn btn-primary btn-lg" href="/mapserver" role="button">Acessar &raquo;</a></p>
  </div>
</div>

<div class="container-fluid">
  <!-- Linha de três colunas -->
  <div class="row">
    <div class="col-md-4">
      <img src="/imagens/teamwork_logo.png" >
      <h3>Teamwork</h3>
      <p>Esta é a nossa ferramenta de gestão de projetos, utilizada para o acompanhamento de atividades e lançamentos de horas. </p>
      <p><a class="btn btn-primary" href="https://vallenge.eu.teamwork.com" role="button">Acessar &raquo;</a></p>
    </div>
    <div class="col-md-4">
      <img src="/imagens/geoserver_logo.png">
      <h3>GeoServer</h3>
      <p>O GeoServer é um servidor projetado para interoperabilidade, ele publica dados de qualquer fonte de dados espaciais principais usando padrões abertos. </p>
      <p><a class="btn btn-primary" href="http://192.168.100.211:8080/geoserver/web/" role="button">Acessar &raquo;</a></p>
    </div>
    <div class="col-md-4">
      <img src="/imagens/srv-info.png">
      <h3>ServerTest</h3>
      <p>Área reservada para a equipe de desenvolvimento da Mapio efetuar os testes apropriados no MAPIOSRV. Apontado para o PHP-INFO.</p>
      <p><a class="btn btn-primary" href="phpteste.php" role="button">Testar &raquo;</a></p>
    </div>
  </div>
</div>



<?php include(FOOTER_TEMPLATE); ?>
