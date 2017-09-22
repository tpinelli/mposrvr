<?php
    require_once('functions.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Projetos</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Projeto</a>
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
		<th>Titulo</th>
		<th width="23%">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($projects) : ?>
<?php foreach ($projects as $project) : ?>
	<tr>
		<td><?php echo $project['mps01_cd_prj']; ?></td>
		<td><?php echo $project['mps01_nm_proj']; ?></td>
		<td><?php echo $project['mps01_ds_proj']; ?></td>
		<td class="actions text-right">
      <a href="/camprj/index.php?mps01_cd_prj=<?php echo $project['mps01_cd_prj']; ?>" class="btn btn-sm btn-info"><i class="fa fa-map-o"></i> Camadas</a>
			<a href="edit.php?mps01_cd_prj=<?php echo $project['mps01_cd_prj']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
			<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $project['mps01_cd_prj']; ?>">
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
