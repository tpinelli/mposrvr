/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget);
  var id = button.data('customer');
  var ord = button.data('ordem');

  var modal = $(this);

  modal.find('#confirm').attr('href', 'delete.php?id=' + id + '&ord=' + ord);
})
