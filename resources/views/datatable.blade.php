<!DOCTYPE html>
<html>
<head>
    <title>Laravel 5 - Implementing datatables tutorial using yajra package</title>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">

 
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
</head>
<body>


<div class="container">
  <table id="users" class="table table-hover table-condensed" style="width:100%">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Name</th>                                            
            <th style="min-width:80px;">Email</th>
            <th>Phone</th>                                            
            <th>Photo</th>
            <th>Dob</th>
            <th>Gender</th>
            <th>Registerd At</th>                                           
            <th style="min-width:50px; text-align:center">Edit</th>
            <th style="min-width:50px; text-align:center">Delete</th>
        </tr>
    </thead>
  </table>
</div>


<script type="text/javascript">
$(document).ready(function() {
    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('datatable.getposts') }}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'contact_no', name: 'contact_no'},
            // {data: 'image', name: 'image'},
            {
                render: function (data, type, column, meta) {
                    return '<img class="img-thumbnail" src="{{ asset("/images/")}}'+'/'+column.image+'" >'; 
                }
            },
            {data: 'dob', name: 'dob'},
            {data: 'gender', name: 'gender'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, column, meta) {
                   return '<a href="{{ url('admin/edit',['id' => encrypt(' .column.id. ')]) }}" class="btn btn-xs  btn-info"><i class="fa fa-info-circle"></i>Edit</a>';
                }
            },
            {
                data: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, column, meta) {
                   return '<a href="{{ url('admin/edit',['id' => encrypt(' .column.id. ')]) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>Delete</a>';
                }
            }
        ]
    });
});

</script>
</body>
</html>