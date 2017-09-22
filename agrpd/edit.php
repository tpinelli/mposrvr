<?php
  require_once('functions.php');
  edit();



?>

<?php include(HEADER_TEMPLATE); ?>


<h2>Atualizar Agrupadores</h2>

<form action="edit.php?mps05_cd_agrpd=<?php echo $agrpd["mps05_cd_agrpd"]; ?>" method="post">
  <!-- area de campos do form -->
  <hr />

  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Código do Agrupador</label>
      <input type="text" class="form-control" maxlength="7" name="agrpd['mps05_cd_agrpd']" value="<?php echo $agrpd["mps05_cd_agrpd"]; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Nome do Agrupador</label>
      <input type="text" class="form-control" maxlength="30" name="agrpd['mps05_nm_agrpd']" value="<?php echo $agrpd["mps05_nm_agrpd"]; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Descrição do Agrupador</label>
      <textarea class="form-control" rows="3" maxlength="60" name="agrpd['mps05_ds_agrpd']"><?php echo $agrpd["mps05_ds_agrpd"]; ?></textarea>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Legenda do Agrupador</label>
      <input type="text" class="form-control" maxlength="50" name="agrpd['mps05_lg_agrpd']" value="<?php echo $agrpd["mps05_lg_agrpd"]; ?>">
    </div>
  </div>




  </div>
  <div id="actions" class="row">
    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Salvar</button>
      <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
