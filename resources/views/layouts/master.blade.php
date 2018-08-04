
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta name="_token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
 <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
 
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('/images/profile.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>

        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
         @can('isAdmin')
        <li class="header">You are admin</li>
         @endcan
         @can('isEmployee')
        <li class="header">You are employee</li>
         @endcan
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{route('home')}}"><i class="fa fa-link"></i> <span>Home</span></a></li>
        <li><a href="{{url('company')}}"><i class="fa fa-link"></i> <span>Companies</span></a></li>
        <li><a href="{{url('employee')}}"><i class="fa fa-link"></i> <span>Employees</span></a></li>

        <li class="">

           <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
             <i class="fa fa-power-off text-red"></i>   <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

       @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->

    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="http://femto15.com">Femto15</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="{{asset('js/app.js')}}"></script>



<script>
    
  $(document).ready(function(){

 fetch_company_data();
 fetch_employee_data();
 
 function fetch_company_data(query = '')
 {
  $.ajax({
   url:"{{ route('company.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#company-tbody').html(data.table_data);
    $('#company_total_records').text(data.total_data);
   },error:function(){ 
            alert("error!!!!");
        }
  })
 }



 $(document).on('keyup', '#search-company', function(){
  var query = $(this).val();
  fetch_company_data(query);
 });

  function fetch_employee_data(query = '')
 {
  $.ajax({
   url:"{{ route('employee.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#employee-tbody').html(data.table_data);
    $('#employee_total_records').text(data.total_data);
   },error:function(){ 
            alert("error!!!!");
        }
  })
 }



 $(document).on('keyup', '#search-employee', function(){
  var query = $(this).val();
  fetch_employee_data(query);
 });
});

    $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var name = button.data('myname') 
      var email = button.data('myemail') 
      var tel = button.data('mytel') 
      var address = button.data('myaddress') 
      var company_id = button.data('companyid') 
      var modal = $(this)
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #email').val(email);
      modal.find('.modal-body #tel').val(tel);
      modal.find('.modal-body #address').val(address);
      modal.find('.modal-body #company_id').val(company_id);
})

  $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var company_id = button.data('companyid') 
      var modal = $(this)
      modal.find('.modal-body #company_id').val(company_id);
})

    $('#edit-employee').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var name = button.data('myname') 
      var email = button.data('myemail') 
      var phone = button.data('myphone') 
      var company_id = button.data('companyid') 
      var nth_child = company_id-1;
      var employee_id = button.data('employeeid') 
      var modal = $(this)
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #email').val(email);
      modal.find('.modal-body #phone').val(phone);
      modal.find('.modal-body #my_company_id').children().removeAttr("selected");
      modal.find('.modal-body #my_company_id option:nth-child('+nth_child+')').attr("selected","selected");
      modal.find('.modal-body #employee_id').val(employee_id);
      console.log(company_id);
})

      $('#delete-employee').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var employee_id = button.data('employeeid') 
      var modal = $(this)
      modal.find('.modal-body #employee_id').val(employee_id);
})


</script>
<script type="text/javascript">
 
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
 
</script>
</body>
</html>
