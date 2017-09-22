<?php
  require_once('functions.php');
  add();

?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Campos - <?php echo $_GET['mps03_cd_camada']?></h2>

<form action="add.php?mps03_cd_camada=<?php echo $_GET['mps03_cd_camada']; ?>&ordem=<?php echo $_GET['ordem'] ?>" method="post">
  <!-- area de campos do form -->
  <hr />


  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Nome do Campo</label>
      <input type="text" class="form-control" maxlength="60" name="campo['mps06_nm_campo']">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Descrição do Campo</label>
      <textarea class="form-control" rows="3" maxlength="120" name="campo['mps06_ds_campo']"></textarea>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Legenda do Campo</label>
      <input type="text" class="form-control" maxlength="60" name="campo['mps06_lg_campo']">
    </div>
  </div>
  <?php $ordem = $_GET['ordem'] + 1; ?>
  <input type="hidden" name="campo['mps06_cd_ordem']" value="<?php echo $ordem;?>">
  <input type="hidden" name="campo['mps06_cd_camada']" value="<?php echo $_GET['mps03_cd_camada'];?>">

  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="index.php?mps03_cd_camada=<?php echo $_GET['mps03_cd_camada']; ?>" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
