$(function () {
  $('#order-table').DataTable({
    dom: 'lifrtp',
    processing: true,
    serverSide: true,
    ajax: {
      url: '/admin/orders/datatables',
    },
    columns: [
      {data: 'id', name: 'id'},
      {data: 'name', name: 'name'},
      {data: 'email', name: 'email'},
      {data: 'address', name: 'address'},
      {data: 'phone', name: 'phone'},
      {data: 'total', name: 'total'},
      {data: 'subtotal', name: 'subtotal'},
      {data: 'tax', name: 'tax'},
      {data: 'action', name: 'action'},
    ]
  });
});

$.fn.dataTable.ext.classes.sLengthSelect = 'border-0 background-none';
$.fn.dataTable.ext.classes.sPageButton = 'btn btn-success';
$.fn.dataTable.ext.classes.sFilterInput = 'filter';

function deleteOrder(id) {
  $('#link-detele-order').attr('href', '/admin/orders/' + id + '/delete');
}
