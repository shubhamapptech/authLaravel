
@include('Admin.layout.header',['page'=>'two'])
          
            <!-- PAGE CONTENT WRAPPER -->

                <div class="page-content-wrap">

                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Customers</strong></h3>
                                    <?php if(isset($success)==1){ ?>
                                    <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message;?>
                                    </div>        
                                    <?php } else if(isset($error)==1) { ?>
                                    <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message;?>
                                    </div>
                                    <?php }?>     
                                </div>   
                                       @if (Session::has('msg'))
                                        <div class="row alert-row">
                                          <div class="col-md-12">
                                            <div  class="alert alert-{{ Session::get('color') }} alert-custome">
                                               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                               <p>{{ Session::get('msg') }}</p>
                                            </div>
                                          </div>
                                        </div>
                                    @endif                
                                <div class="panel-body">

                                            
                                    <div class="table-responsive">
                                    <div id="list_table" style="overflow:scroll;">
                                        <table id="users" class="table table-hover table-condensed" style="width:100%">
                                     {{-- <table id="example" class="table display"> --}}
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
                                    </div>
                                </div>

                            </div>
                            <!-- END DATATABLE EXPORT -->
                        </div>
                    </div>
                </div>         
                <!-- END PAGE CONTENT WRAPPER -->

@include('Admin.layout.second_footer')
    
<script type="text/javascript">
$(document).ready(function() {
    var i=1;
    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('customers.search') }}",

        "columns": [            
            {data:'id', name:i++ },
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'contact_no', name: 'contact_no'},
            // {data: 'image', name: 'image'},
            {
                render: function (data, type, column, meta) {
                    return '<img class="img-thumbnail" src="{{ asset("/images/")}}'+'/'+column.image+'" width="60" height="60" >'; 
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
                    // '+'/'+column.id+'
                    var id = column.id;                    
                    return '<a href="{{ url('edit_customer') }}'+'/'+column.id+'" class="btn btn-xs  btn-info"><i class="fa fa-edit"></i>Edit</a>';                    
                }
            },
            {
                data: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, column, meta) {
                   return '<a href="{{ url('delete_customer') }}'+'/'+column.id+'" class="btn btn-xs btn-primary"><i class="fa fa-info-circle"></i>Delete</a>';
                }
            }
        ]
    });
});

</script>

