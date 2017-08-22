<?php
    require_once('functions.php');
    add();
    $nmOrdem = $_GET['mps04_nm_ordem'] + 1;
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Adicionar Camada - <?php echo $_GET['mps01_cd_prj']; ?></h2>
		</div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
	<?php clear_messages(); ?>
<?php endif; ?>

<form action="add.php?mps01_cd_prj=<?php echo $_GET['mps01_cd_prj']; ?>" method="post">

<hr>

<table class="table table-hover">
<thead>
	<tr>
    <th>#</th>
		<th>Código</th>
		<th>Nome</th>
		<th>Legenda</th>
    <th>URL-WS</th>
    <th>Layer</th>
	</tr>
</thead>
<tbody>
<?php if ($camadas) : ?>
<?php foreach ($camadas as $camada) : ?>
<?php $verif = find('mapsrv.mps04_prj_cam', $_GET['mps01_cd_prj'], 'mps01_cd_prj' ,$camada['mps03_cd_camada'], 'mps03_cd_camada'); ?>
	<tr>
    <td><input class="form-check-input" type="radio" name="camprj['mps03_cd_camada']" id="prjs" value="<?php echo $camada['mps03_cd_camada']; ?>" <?php if($verif): ?> DISABLED <?php endif; ?>></td>
		<td><?php echo $camada['mps03_cd_camada']; ?></td>
		<td><?php echo $camada['mps03_nm_camada']; ?></td>
		<td><?php echo $camada['mps03_ds_legenda']; ?></td>
    <td><?php echo $camada['mps03_ur_camada']; ?></td>
    <td><?php echo $camada['mps03_ly_camada']; ?></td>
	</tr>
<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>
    <input type="hidden" name="camprj['mps01_cd_prj']" value="<?php echo $_GET['mps01_cd_prj']; ?>">
    <input type="hidden" name="camprj['mps04_nm_ordem']" value="<?php echo $nmOrdem; ?>">
<div id="actions" class="row">
  <div class="col-md-12">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="index.php?mps01_cd_prj=<?php echo $_GET['mps01_cd_prj']; ?>" class="btn btn-default">Cancelar</a>
  </div>
</div>
</form>
<?php include(MODAL_EXCLUIR); ?>
<?php include(FOOTER_TEMPLATE); ?>
