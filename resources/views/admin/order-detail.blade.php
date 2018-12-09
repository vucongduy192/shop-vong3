@extends('admin.layouts.template')
@section('link')
  <link href="/order-admin-page/css/step-wizard.css" rel="stylesheet"/>
@endsection
@section('main')
  <div class="content">
    <div class="modal fade" id="change-dialog" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Change state</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-3">
            You want to change state !!!
          </div>
          <div class="modal-footer">
            <form method="POST" action="/admin/orders/{{ $id }}">
              @csrf
              <input type="text" value="" name="status" hidden/>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success"><a href="#" class="text-white">Save</a></button>
            </form>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title ">Orders Detail</h4>
            </div>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" value="{{ $order->name }}" disabled/>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" value="{{ $order->email }}" disabled/>
                </div>
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" value="{{ $order->phone }}" disabled/>
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" value="{{ $order->address }}" disabled/>
                </div>
                <div class="form-group">
                  <label>Total</label>
                  <input type="text" class="form-control" value="{{ $order->total }}" disabled/>
                </div>
                <div class="form-group">
                  <label>Subtotal</label>
                  <input type="text" class="form-control" value="{{ $order->subtotal }}" disabled/>
                </div>
                <div class="form-group">
                  <label>Tax</label>
                  <input type="text" class="form-control" value="{{ $order->tax }}" disabled/>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title ">Order Item List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="orderitem-table">
                  <thead>
                  <th>Id</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Size</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="card">
          <div class="card-body">
            <ul class="col-md-12 d-flex justify-content-around wizard wizard-header">
              <li>
                <h5>Pending</h5>
              </li>
              <li>
                <h5>Payment</h5>
              </li>
              <li>
                <h5>Shipping</h5>
              </li>
              <li>
                <h5>Complete</h5>
              </li>
            </ul>
            <ul class="col-md-12 d-flex justify-content-around wizard wizard-logo">
              <li data-target="1">
                <i class="material-icons">add_shopping_cart</i>
              </li>
              <li data-target="2">
                <i class="material-icons">payment</i>
              </li>
              <li data-target="3">
                <i class="material-icons">local_shipping</i>
              </li>
              <li data-target="4">
                <i class="material-icons">thumb_up</i>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script>
    $(function () {
      $('#orderitem-table').DataTable({
        dom: 'lifrtp',
        processing: true,
        serverSide: true,
        ajax: {
          url: '/admin/orders/{{ $id }}/datatables',
        },
        columns: [
          {data: 'id', name: 'id'},
          {data: 'product.name', name: 'product'},
          {data: 'quantity', name: 'quantity'},
          {data: 'price', name: 'price'},
          {data: 'size', name: 'size'},
        ]
      });
    });

    $.fn.dataTable.ext.classes.sLengthSelect = 'border-0 background-none';
    $.fn.dataTable.ext.classes.sPageButton = 'btn btn-success';
    $.fn.dataTable.ext.classes.sFilterInput = 'filter';

    var liLogo = $('.wizard-logo li');
    var liHeader = $('.wizard-header li');

    $.ajax({
      url: '/admin/orders/{{ $id }}/api'
    }).done(function ({data}) {
      for (var i = 0; i < liHeader.length; i++) {
        if (i <= data.status - 1) {
          $(liHeader[i]).addClass('active');
          $(liLogo[i]).addClass('active');
        }
      }
    });

    $('.wizard-logo li').click(function () {
      $('input[name=status]').attr('value', $(this).attr('data-target'));
      $('#change-dialog').modal('toggle');
    });
  </script>
@endsection

