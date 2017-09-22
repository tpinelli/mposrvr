<?php
    require_once('functions.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Camadas</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Nova Camada</a>
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
		<th>Legenda</th>
    <th>URL-WS</th>
    <th>Layer</th>
		<th width="18%">Opções</th>
	</tr>
</thead>
<tbody>
<?php if ($camadas) : ?>
<?php foreach ($camadas as $camada) : ?>
	<tr>
		<td><?php echo $camada['mps03_cd_camada']; ?></td>
		<td><?php echo $camada['mps03_nm_camada']; ?></td>
		<td><?php echo $camada['mps03_ds_legenda']; ?></td>
    <td><?php echo $camada['mps03_ur_camada']; ?></td>
    <td><?php echo $camada['mps03_ly_camada']; ?></td>
		<td class="actions text-right">
      <a href="/campos/index.php?mps03_cd_camada=<?php echo $camada['mps03_cd_camada'];?>" class="btn btn-sm btn-default"><i class="fa fa-plus-square-o"></i></a>
			<a href="edit.php?mps03_cd_camada=<?php echo $camada['mps03_cd_camada']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
			<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $camada['mps03_cd_camada']; ?>">
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
