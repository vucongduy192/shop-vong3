@extends('admin.layouts.template')
@section('main')
  <div class="content">
    <div class="modal fade" id="delete-order" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Orders</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-3">
            Delete. Are you sure?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a class="btn btn-danger" id="link-detele-order">Sure
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        @if (!empty(session('success')))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
        @endif
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          @component('admin.component.card-stats')
            @slot('style')
              card-header-danger
            @endslot

            @slot('logo')
              <i class="material-icons">add_shopping_cart</i>
            @endslot

            @slot('category')
              Pendding
            @endslot

            @slot('title')
              {{ $pending }}
            @endslot
          @endcomponent
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          @component('admin.component.card-stats')
            @slot('style')
              card-header-warning
            @endslot
            @slot('logo')
              <i class="material-icons">payment</i>
            @endslot

            @slot('category')
              Payment
            @endslot

            @slot('title')
              {{ $payment }}
            @endslot
          @endcomponent
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          @component('admin.component.card-stats')
            @slot('style')
              card-header-info
            @endslot

            @slot('logo')
              <i class="material-icons">local_shipping</i>
            @endslot

            @slot('category')
              Shipping
            @endslot

            @slot('title')
              {{ $shipping }}
            @endslot
          @endcomponent
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          @component('admin.component.card-stats')
            @slot('style')
              card-header-success
            @endslot
            @slot('logo')
              <i class="material-icons">thumb_up</i>
            @endslot

            @slot('category')
              Complete
            @endslot

            @slot('title')
              {{ $complete }}
            @endslot
          @endcomponent
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Orders List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="order-table">
                  <thead>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Total</th>
                  <th>Subtotal</th>
                  <th>Tax</th>
                  <th>Action</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
  <script src="/order-admin-page/js/order-list.js"></script>
@endsection
