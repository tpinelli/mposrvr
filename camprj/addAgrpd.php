<?php
    require_once('functions.php');
    addAgrpd();

?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Adicionar Agrupador - <?php echo $_GET['mps01_cd_prj'] . ' X ' . $_GET['cdAgrpd']; ?></h2>
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

<form action="addAgrpd.php?mps01_cd_prj=<?php echo $_GET['mps01_cd_prj']; ?>&cdAgrpd=<?php echo $_GET['cdAgrpd'];?>" method="post">

<hr>

<table class="table table-hover">
<thead>
	<tr>
    <th>#</th>
		<th>Código</th>
		<th>Nome</th>
		<th>Legenda</th>
    <th>Descrição</th>
	</tr>
</thead>
<tbody>
  <tr>
    <td><input class="form-check-input" type="radio" name="agrpdSel['mps04_cd_agrpd']" id="selNul" value="NULL"></td>
    <td colspan="5">Sem Agrupador</td>
<?php if ($agrpds) : ?>
<?php foreach ($agrpds as $agrpd) : ?>
	<tr>
    <td><input class="form-check-input" type="radio" name="agrpdSel['mps04_cd_agrpd']" id="prjs" value="<?php echo $agrpd['mps05_cd_agrpd']; ?>"></td>
		<td><?php echo $agrpd['mps05_cd_agrpd']; ?></td>
		<td><?php echo $agrpd['mps05_nm_agrpd']; ?></td>
		<td><?php echo $agrpd['mps05_ds_agrpd']; ?></td>
    <td><?php echo $agrpd['mps05_lg_agrpd']; ?></td>
	</tr>
<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>
<div id="actions" class="row">
  <div class="col-md-12">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="index.php?mps01_cd_prj=<?php echo $_GET['mps01_cd_prj']; ?>" class="btn btn-default">Cancelar</a>
  </div>
</div>
</form>
<?php include(MODAL_EXCLUIR); ?>
<?php include(FOOTER_TEMPLATE); ?>
