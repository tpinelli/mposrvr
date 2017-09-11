<?php
    require_once('functions.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Campos - <?php echo $_GET['mps03_cd_camada']; ?></h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php?mps03_cd_camada=<?php echo $_GET['mps03_cd_camada']; ?>&ordem=<?php echo count($campos); ?>"><i class="fa fa-plus"></i> Novo Campo</a>
	    	<a class="btn btn-default" href="index.php?mps03_cd_camada=<?php echo $_GET['mps03_cd_camada']; ?>"><i class="fa fa-refresh"></i> Atualizar</a>
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
		<th>Campo</th>
		<th>Legenda</th>
		<th>Descrição</th>
		<th width="18%">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($campos) : ?>
<?php foreach ($campos as $campo) : ?>
	<tr>
		<td><?php echo $campo['mps06_nm_campo']; ?></td>
		<td><?php echo $campo['mps06_lg_campo']; ?></td>
		<td><?php echo $campo['mps06_ds_campo']; ?></td>
		<td class="actions text-right">
			<a href="up.php?camada=<?php echo $campo['mps06_cd_camada']; ?>&ordem=<?php echo $campo['mps06_cd_ordem']; ?>&campo=<?php echo $campo['mps06_id_campo']; ?>" class="btn btn-sm btn-info" <?php if ($campo['mps06_cd_ordem']==1): ?> DISABLED <?php endif ?>><i class="fa fa-caret-up"></i></a>
			<a href="down.php?camada=<?php echo $campo['mps06_cd_camada']; ?>&ordem=<?php echo $campo['mps06_cd_ordem']; ?>&campo=<?php echo $campo['mps06_id_campo']; ?>" class="btn btn-sm btn-info" <?php if ($campo['mps06_cd_ordem']==count($campos)): ?> DISABLED <?php endif ?>><i class="fa fa-caret-down"></i></a>
      <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $campo['mps06_id_campo']; ?>" data-cam="<?php echo $campo['mps06_cd_camada']; ?>" data-ordem="<?php echo $campo['mps06_cd_ordem']; ?>">
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
