<?php
  require_once('functions.php');
  add();
  //$nv = nextval('mapsrv."MPS05_AGRPD_MPS05_CD_AGRPD_seq"');
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Agrupador</h2>

<form action="add.php" method="post">
  <!-- area de campos do form -->
  <hr />
  <!--
  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Código do Agrupador</label>
      <input type="text" class="form-control" maxlength="7" name="agrpd['mps05_cd_agrpd']" value="<?php echo $nv['nextval'];?>" disabled>
    </div>
  </div>
  -->
  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Nome do Agrupador</label>
      <input type="text" class="form-control" maxlength="30" name="agrpd['mps05_nm_agrpd']">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Descrição do Agrupador</label>
      <textarea class="form-control" rows="3" maxlength="60" name="agrpd['mps05_ds_agrpd']"></textarea>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Legenda do Agrupador</label>
      <input type="text" class="form-control" maxlength="50" name="agrpd['mps05_lg_agrpd']">
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
