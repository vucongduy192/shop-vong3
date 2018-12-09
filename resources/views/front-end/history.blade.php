@extends('front-end.app_default')
@section('content')
<div style="padding: 20px">
  <form action="/history/list" method="GET">
  <div class="row" >
        <div class="col-md-6" style="margin-left:25%;margin-top: 20px;margin-bottom: 20px">
            <div>
                <div class="input-group">
                    <input type="text" class="form-control input-lg" name="key" id="key" placeholder="Input email or phone to searh list order..." />
                    <input type="submit" class="btn btn-info" value="Search">
                </div>
            </div>
        </div>
  </div>
  </form>
</div>
<div class="container col-md-6">
  @if(!empty($list))
  @foreach($list as $ds)
  <div class="card" style="padding: 1%;margin-top: 50px;margin-bottom:50px" >
    <div class="card-header">
      Tên người nhận : {{$ds['name']}}<br>

    </div>
    <div class="card-content">
      Địa chỉ : {{$ds['address']}}<br>
      SĐT : {{$ds['phone']}}<br>
      Tổng tiền : {{$ds['total']}} VNĐ<br>
      Date : {{$ds['created_at']}}
    </div>
  </div>
  @endforeach
  @elseif(!empty($notfound))
  <div class="card bg-light text-center" style="padding: 5%;margin-bottom: 100px">
      {{$notfound}}
  </div>
  @else
  <div class="card bg-light text-center" style="padding: 5%;margin-bottom: 100px">
      Nhập email hoặc số điện thoại để theo dõi hóa đơn của bạn!
  </div>
  @endif
</div>
@stop