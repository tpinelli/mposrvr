<?php
    require_once('functions.php');
    index();
?>

<?php include(HEADER_TEMPLATE); ?>

<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/layout.css" type="text/css">
<link rel="stylesheet" href="<?php echo BASEURL; ?>/css/gerais.css" type="text/css">

<header>
	<div class="row">
		<div class="col-sm-6">
			<h2>Mapas Disponíveis</h2>
		</div>
	</div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $_SESSION['message']; ?>
	</div>
	<?php //clear_messages(); ?>
<?php endif; ?>

<hr>

<!-- novo código -->
<div class="container-fluid">
  <div id="examples"><div class="row">

    <?php if ($projects) : ?>
    <?php foreach ($projects as $project) : ?>

      <div class="col-md-4 col-sm-4">
      <!--    <a class="example" href="mapview.php?cdprj=]?>> -->
        <?php
          echo '<a class="example" href="view.php?cdprj='. $project['mps01_cd_prj']. '">';
        ?>
          <span class="mainlink">
            <strong><?php print $project['mps01_nm_proj']?></strong><br>
            <small><?php print $project['mps01_cd_prj']?></small>
          </span>
            <p class="description"><?php print $project['mps01_ds_proj']?></p>
        </a>
      </div>


<!-- código antigo -->

<?php endforeach; ?>
<?php else : ?>
	<tr>
		<td colspan="6">Nenhum registro encontrado.</td>
	</tr>
<?php endif; ?>
</div></div></div>
</tbody>
</table>

<?php include(FOOTER_TEMPLATE); ?>
