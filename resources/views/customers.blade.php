@extends('layouts.main')
@section('title') Customers @endsection
@section('content')
<section class="content-header">
  <h1>
    Customers
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Customers</li>
  </ol>
</section>
<section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Customers</h3>

        <div class="box-tools pull-right">
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table id="customersTable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Customer Number</th>
                <th>Customer Name</th>
                <th>Contact Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>State</th>
                <th>Orders</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($customers as $customer): ?>
            <tr>
              <td>{{$customer->getKey()}}</td>
              <td>{{$customer->customerName()}}</td>
              <td>{{$customer->contactFullName()}}</td>
              <td>{{$customer->address()}}</td>
              <td>{{$customer->city()}}</td>
              <td>{{$customer->postalCode()}}</td>
              <td>{{$customer->country()}}</td>
              <td>{{$customer->state()}}</td>
              <td><a href="{{ route('customer-orders',['id' => $customer->getKey()]) }}">Click Here</a></td>
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
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "{{ route('customers-ajax') }}",
          "dataType": 'json',
          "type": 'POST',
          "data": {'_token': '{{ csrf_token() }}' }
      },
      "columns":[
          {"data":"customerNumber"},
          {"data":"customerName"},
          {"data":"contactName"},
          {"data":"address"},
          {"data":"city"},
          {"data":"postalCode"},
          {"data":"country"},
          {"data":"state"},
          {"data":"link"},
        ],
        "deferLoading": "{{ $totalCount }}"
      });
  </script>
   @if (session('error'))
    <script>
      $.notify('{{ session('error') }}','error')
    </script>
  @endif
@endsection