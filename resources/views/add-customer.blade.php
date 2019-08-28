@extends('layouts.main')
@section('title') Add Customer @endsection
@section('links')
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('theme/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('theme/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/select2/dist/css/select2.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('theme/dist/css/AdminLTE.min.css')}}">
@endsection
@section('style')
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }
  </style>
@endsection
@section('content')
<section class="content-header">
  <h1>
    Add Customer
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Add Customer</li>
  </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add Customer</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{ route('add-customer-submit') }}" method="post">
            @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer Name</label>
                <input type="text" name="customer_name" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Contact First Name</label>
                <input type="text" name="first_name" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Contact Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Phone #</label>
                <input type="number" name="phone" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Address Line 1</label>
                <input type="text" name="address1" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Address Line 2</label>
                <input type="text" name="address2" class="form-control">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Country</label>
                <select class="form-control select2" name="country" data-placeholder="Select a Country"
                        style="width: 100%;" required>
                  <option>UK</option>
                  <option>America</option>
                  <option>Pakistan</option>
                  <option>Bangladesh</option>
                  <option>France</option>
                  <option>Australia</option>
                </select>
              </div>

              <div class="form-group">
                <label>State</label>
                <select class="form-control select2" name="state" data-placeholder="Select a State"
                        style="width: 100%;">
                  <option>Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>

              <div class="form-group">
                <label>City</label>
                <select class="form-control select2" name="city" style="width: 100%;" required>
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Postal code</label>
                <input type="text" name="post_code" class="form-control">
              </div>

              <div class="form-group">
                <label>Credit Limit</label>
                <input type="number" name="credit_limit" class="form-control">
              </div>

              <div class="form-group">
                <input type="submit" class="form-control btn btn-primary" value="Add Customer">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          </form>
        </div>
        <!-- /.box-body -->
      </div>
</section>

@endsection
@section('script')
<script src="{{asset('theme/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('theme/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('theme/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('theme/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('theme/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('theme/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('theme/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('theme/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('theme/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('theme/bower_components/fastclick/lib/fastclick.js')}}"></script>
 @if (session('error'))
  <script>
    $.notify('{{ session('error') }}','error')
  </script>
@endif
@if (session('success'))
  <script>
    $.notify('{{ session('success') }}','success')
  </script>
@endif
@if ($errors)
    <script type="text/javascript">
      <?php 
        $errs = $errors->all();
        rsort($errs);
      ?>
      @foreach($errs as $error)
        $.notify("{{$error}}",'error');
      @endforeach
    </script>
  @endif
<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
  </script>
   @if (session('error'))
    <script>
      $.notify('{{ session('error') }}','error')
    </script>
  @endif
@endsection