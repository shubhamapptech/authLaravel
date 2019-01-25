@extends('admin.layouts.app')
  @section('content')   
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Users
      {{--   <small>it all starts here</small> --}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
        <li class="active">Admin Users</li>
      </ol>
    </section>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
             {{--  <h3 class="box-title">Data Table With Full Features</h3> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="adminTable" class="table table-bordered table-responsive table-striped table-hover">
                <thead>
                <tr>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Mobile</th>
                 <th>Country</th>
                 <th>Status</th>
                 <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    @endsection
    @section('css-script')
      <!-- Bootstarap Validator script -->
      <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrapValidator.min.css') }}">
       <!-- Bootstrap Select2 script -->
       <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/select2.min.css') }}">
        <!-- Bootstrap datatable script -->
       <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/dataTables.bootstrap.min.css') }}">
    @endsection
    @section('js-script')
       <!-- custome js script -->
      <script src="{{ asset('admin/js/js.min.js')}}"></script>
      <!-- Bootstarap Validator script -->
      <script src="{{ asset('admin/js/bootstrapValidator.min.js')}}"></script>
      <!-- Bootstrap Jquery DataTables -->
      <script src="{{ asset('admin/js/jquery.dataTables.min.js')}}"></script>
      <!-- Bootstrap DataTables -->
      <script src="{{ asset('admin/js/dataTables.bootstrap.min.js')}}"></script>
      
      <script type="text/javascript">
           $(function(){
               $('#adminTable').DataTable( {
                 scrollY    : '500px',
          scrollCollapse    : true,
               paging       : true,
                 responsive : true,
                 processing : true,
                 serverSide : true,
                 ajax       :  '{{ route('admin/table') }}',
                columns : [
                    { data : 'name'},
                    { data : 'email' , name : 'email'  },
                    { data : 'mobile' , name :  'mobile'},
                    { data : 'country_name' , name : 'country_name'  },
                    { 
                            data : 'is_active' ,
                            name : 'is_active' , 
                            render: function (data, type, column, meta) {
                               return column.is_active == 1 ? '<span style="color: green;">Active</span>' : '<span style="color: red;">Inactive</span>' ;
                            }
                    },
                    {
                            data: 'action',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, column, meta) {
                               return '<a href="{{ route('admin/edit',['id' => encrypt(' .column.id. ')]) }}" class="btn btn-xs  btn-info"><i class="fa fa-info-circle"></i></a> <a href="{{ route('admin/edit',['id' => encrypt(' .column.id. ')]) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> <a href="{{ route('admin/edit',['id' => encrypt(' .column.id. ')]) }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
                            }
                    }
                ]
               });
            });
        </script>
    @endsection
