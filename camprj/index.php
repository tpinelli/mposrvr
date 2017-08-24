<?php
    require_once('functions.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Camadas - <?php echo $_GET['mps01_cd_prj']; ?></h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php?mps01_cd_prj=<?php echo $_GET['mps01_cd_prj']; ?>&mps04_nm_ordem=<?php echo count($camprjs); ?>"><i class="fa fa-plus"></i> Nova Camada</a>
	    	<a class="btn btn-default" href="index.php?mps01_cd_prj=<?php echo $_GET['mps01_cd_prj']; ?>"><i class="fa fa-refresh"></i> Atualizar</a>
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

<hr>

<table class="table table-hover" id="lista_camprj">
<thead>
	<tr>
		<th>Camada</th>
		<th>Legenda</th>
		<th>Descrição</th>
    <th>Agrupador</th>
		<th width="18%">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($camprjs) : ?>
<?php foreach ($camprjs as $camprj) : ?>
	<tr>
		<td><?php echo $camprj['mps03_nm_camada']; ?></td>
		<td><?php echo $camprj['mps03_ds_legenda']; ?></td>
		<td><?php echo $camprj['mps03_ds_camada']; ?></td>
    <td><?php echo listAgrpd($camprj['mps04_cd_agrpd']); ?></td>
		<td class="actions text-right">
      <a href="addAgrpd.php?mps01_cd_prj=<?php echo $camprj['mps01_cd_prj'];?>&cdAgrpd=<?php echo $camprj['mps03_cd_camada'];?>" class="btn btn-sm btn-default"><i class="fa fa-plus-square-o"></i></a>
			<a href="up.php?proj=<?php echo $camprj['mps01_cd_prj']; ?>&ordem=<?php echo $camprj['mps04_nm_ordem']; ?>&camada=<?php echo $camprj['mps03_cd_camada']; ?>" class="btn btn-sm btn-info" <?php if ($camprj['mps04_nm_ordem']==1): ?> DISABLED <?php endif ?>><i class="fa fa-caret-up"></i></a>
			<a href="down.php?proj=<?php echo $camprj['mps01_cd_prj']; ?>&ordem=<?php echo $camprj['mps04_nm_ordem']; ?>&camada=<?php echo $camprj['mps03_cd_camada']; ?>" class="btn btn-sm btn-info" <?php if ($camprj['mps04_nm_ordem']==count($camprjs)): ?> DISABLED <?php endif ?>><i class="fa fa-caret-down"></i></a>
      <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $camprj['mps01_cd_prj']; ?>" data-ordem="<?php echo $camprj['mps04_nm_ordem']; ?>">
				<i class="fa fa-trash"></i> Excluir
			</a>
		</td>
	</tr>
<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</tbody>
</table>
<?php include(MODAL_EXCLUIR); ?>
<?php include(FOOTER_TEMPLATE); ?>
