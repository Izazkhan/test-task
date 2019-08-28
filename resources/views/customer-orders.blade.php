@extends('layouts.main')
@section('title') Customer Orders @endsection
@section('content')
<section class="content-header">
  <h1>
    Customer Orders
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Customer Orders</li>
  </ol>
</section>
<section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $customer->customerName() }}</h3>

        <div class="box-tools pull-right">
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table id="customersTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Required Date</th>
                <th>Shipped Date</th>
                <th>Status</th>
                <th>Comments</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($orders as $order): ?>
            <tr>
              <td>{{ $order->getKey() }}</td>
              <td>{{date('d-m-Y',strtotime($order->orderDate()))}}</td>
              <td>{{ $order->requiredDate }}</td>
              <td>{{ $order->shippedDate }}</td>
              <td>{{ $order->getStatus() }}</td>
              <td>{{ $order->comment() }}</td>
              <td><a href="{{ route('order-details',['id' => $order->getKey()])}}">Click Here</a></td>
            </tr>
            <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        {{-- <a href="#" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> --}}
        {{-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> --}}
      </div>
      <!-- /.box-footer -->
    </div>
</section>

@endsection
@section('script')
  <script>
    $('#customersTable').DataTable({
      });
  </script>
   @if (session('error'))
    <script>
      $.notify('{{ session('error') }}','error')
    </script>
  @endif
@endsection