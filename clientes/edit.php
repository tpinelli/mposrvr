<?php
  require_once('functions.php');
  edit();



?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Atualizar Cliente</h2>

<form action="edit.php?mps02_cd_cli=<?php echo $customer["mps02_cd_cli"]; ?>" method="post">
  <!-- area de campos do form -->
  <hr />
  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Código do Cliente</label>
      <input type="text" class="form-control" readonly="readonly" name="customer['mps02_cd_cli']" value="<?php echo $customer["mps02_cd_cli"]; ?>">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Nome do Cliente</label>
      <input type="text" class="form-control" name="customer['mps02_nm_cli']" value="<?php echo $customer['mps02_nm_cli']; ?>">
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
