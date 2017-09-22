<?php
  require_once('functions.php');
  add();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Projeto</h2>

<form action="add.php" method="post">
  <!-- area de campos do form -->
  <hr />
  <div class="row">
    <div class="form-group col-md-7">
      <label for="name">Código do Projeto</label>
      <input type="text" class="form-control" maxlength="7" name="project['mps01_cd_prj']">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Nome do Projeto</label>
      <input type="text" class="form-control" maxlength="40" name="project['mps01_nm_proj']">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Descrição do Projeto</label>
      <textarea class="form-control" rows="3" maxlength="150" name="project['mps01_ds_proj']"></textarea>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-7">
      <label for="campo1">Cliente</label>
      <select class="form-control" name="project['mps02_cd_cli']">
        <option value=null>** Selecione **</option>
          <!-- buscando a lista de clientes -->
          <?php
              $customers = null;
              $customer = null;
              $customers = find_all('mapsrv.mps02_clientes');
              if ($customers) :
                  foreach ($customers as $customer) :
          ?>
        <option value=<?php echo $customer['mps02_cd_cli'];?>><?php echo $customer['mps02_nm_cli'];?></option>

          <?php endforeach; ?>
          <?php else : ?>
        <option value=null>Não foram encontrados clientes</option>
          <?php endif; ?>

      </select>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-3">
      <label for="campo1">Centro (X):</label>
      <input type="text" class="form-control" maxlength="8" name="project['mps01_cd_cnt_x']">
    </div>
    <div class="form-group col-md-3">
      <label for="campo1">Centro (Y)</label>
      <input type="text" class="form-control" maxlength="8" name="project['mps01_cd_cnt_y']">
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
