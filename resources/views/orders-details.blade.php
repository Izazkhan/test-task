@extends('layouts.main')
@section('title') Order Details @endsection
@section('content')
<section class="content-header">
  <h1>
    Order Details
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Orde details</li>
  </ol>
</section>
<section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Order # {{ $orderNumber }}</h3>

        <div class="box-tools pull-right">
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table id="customersTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Customer</th>
                <th>Product Name</th>
                <th>Quantity Ordered</th>
                <th>Price Each</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($orderDetails as $orderDetail): ?>
            <tr>
              <td>{{ $orderDetail->order->customer->customerName() }}</td>
              <td>{{ $orderDetail->product->productName }}</td>
              <td>{{ $orderDetail->quantityOrdered() }}</td>
              <td>{{ $orderDetail->priceEach() }}</td>
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
   @if (session('error'))
    <script>
      $.notify('{{ session('error') }}','error')
    </script>
  @endif
@endsection