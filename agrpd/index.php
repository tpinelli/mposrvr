<?php
    require_once('functions.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Agrupadores</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Agrupador</a>
	    	<a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
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

<table class="table table-hover">
<thead>
	<tr>
		<th>Código</th>
		<th>Nome</th>
		<th>Descrição</th>
    <th>Legenda</th>
		<th width="15%">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($agrpds) : ?>
<?php foreach ($agrpds as $agrpd) : ?>
	<tr>
		<td><?php echo $agrpd['mps05_cd_agrpd']; ?></td>
		<td><?php echo $agrpd['mps05_nm_agrpd']; ?></td>
		<td><?php echo $agrpd['mps05_ds_agrpd']; ?></td>
    <td><?php echo $agrpd['mps05_lg_agrpd']; ?></td>
		<td class="actions text-right">
			<a href="edit.php?mps05_cd_agrpd=<?php echo $agrpd['mps05_cd_agrpd']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
			<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $agrpd['mps05_cd_agrpd']; ?>">
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
