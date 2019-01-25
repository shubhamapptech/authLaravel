
@include('Admin.layout.header',['page'=>'two','title'=>'Customer List'])
          
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
                                <div class="col-md-12">
                                <form action="/search" method="Post" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q"
                                            placeholder="Search users" value="@if(isset($query)){{ $query }} @endif"> <span class="input-group-btn">
                                            <button type="submit" class="btn btn-danger" style="height:30px;">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>                                      
                                </div>                                
                                    
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <div id="list_table" style="overflow:scroll;">
                                        {{-- <table id="users" class="table table-hover table-condensed" style="width:100%"> --}}
                                     {{-- <table id="example" class="table display"> --}}
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Name</th>                                            
                                                <th style="min-width:80px;">Email</th>
                                                <th>Phone</th>                                            
                                                <th>Photo</th>
                                                <th>Dob</th>
                                                <th>Gender</th>
                                                <th>Active_status</th>
                                                <th>Registerd At</th>                    
                                                <th style="min-width:50px; text-align:center">Edit</th>
                                                <th style="min-width:50px; text-align:center">Delete</th>
                                            </tr>
                                        </thead>  
                                        <tbody>
                                        @if(isset($customers))
                                            <?php $i=1; ?>                                            
                                            @foreach ($customers as $list)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->contact_no }}</td>
                                                <td><img src="{{ url('/images/',$list->image) }}" width="80" height="80"></td>
                                                <td>{{ $list->dob }}</td>
                                                <td>{{ $list->gender }}</td>
                                                <td>@if($list->is_active==0)
                                                    <button class="btn btn-danger status" data-id="{{ $list->id }}">Inactive</button>                           
                                                @else
                                                    <button class="btn btn-success status" data-id="{{ $list->id }}">Active</button>
                                                @endif
                                                </td>
                                                <td>{{ $list->created_at }}</td>
                                                <td><a href="{{ url('/edit_customer',encrypt($list->id)) }}">Edit</a></td>
                                                <td><a href="{{ url('/delete_customer',$list->id) }}">Delete</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table> 
                                    </div>                                   
                                    <div class="pull-right">{{ $customers->links() }}</div>
                                     @endif
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

    $(document).ready(function(){        
        $('.status').click(function(event){
            //alert('hii');
            var id = $(this).attr("data-id");
            let click = this;
            let x = confirm("Do you realy want to change status?");
            if(x){
                $.ajax({
                type:'put',
                dataType:'json',
                url : '{{ url('set_status') }}',
                data: {'customer_id':id,'_token':'{{ csrf_token() }}' },                
                success:function(res){
                    console.log(res);
                    if(res.status=='true'){
                      alert(res.message);
                      if(res.new_status==1){
                        $(click).removeClass('btn-danger');
                        $(click).addClass('btn-success');
                        $(click).html('Active&emsp; ');  
                      }
                      else{
                        $(click).removeClass('btn-success');
                        $(click).addClass('btn-danger');
                        $(click).text('Deactive');
                      }                      
                    }
                    else{
                      alert(res.message);                      
                    }                    
                },
                error:function(res){
                    console.log(res);
                }
                });           
                //alert(id);
            }            
        });
    });

</script>

