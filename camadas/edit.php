<?php
  require_once('functions.php');
  edit();



?>

<?php include(HEADER_TEMPLATE); ?>


<h2>Atualizar Camadas</h2>

<form action="edit.php?mps03_cd_camada=<?php echo $camada["mps03_cd_camada"]; ?>" method="post">
  <!-- area de campos do form -->
  <hr />

  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Código da Camada</label>
      <input type="text" class="form-control" maxlength="7" name="camada['mps03_cd_camada']" value="<?php echo $camada["mps03_cd_camada"]; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Nome da Camada</label>
      <input type="text" class="form-control" maxlength="30" name="camada['mps03_nm_camada']" value="<?php echo $camada["mps03_nm_camada"]; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Descrição da Camada</label>
      <textarea class="form-control" rows="3" maxlength="60" name="camada['mps03_ds_camada']"><?php echo $camada["mps03_ds_camada"]; ?></textarea>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Legenda da Camada</label>
      <input type="text" class="form-control" maxlength="50" name="camada['mps03_ds_legenda']" value="<?php echo $camada["mps03_ds_legenda"]; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">URL da Camada</label>
      <input type="text" class="form-control" maxlength="120" name="camada['mps03_ur_camada']"  value="<?php echo $camada["mps03_ur_camada"]; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Layer</label>
      <input type="text" class="form-control" maxlength="60" name="camada['mps03_ly_camada']"  value="<?php echo $camada["mps03_ly_camada"]; ?>">
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
