

@include('Admin.layout.header',['page'=>'two'])
<!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Update </strong> Customer</h3>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div><br/>
                                @endif
                       
                                <div class="container-fluad">  
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

                                    <form method="post" action="{{ url('update_customer', encrypt($id))}}" class="form-horizontal" enctype="multipart/form-data" id="jvalidate" name="frm">
                                     {{ csrf_field() }}
                                        <div class="panel-body form-group-separated">

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Name</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" name="name" class="form-control" value="{{ $data->name }}" > 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">E-mail</label>
                                                <div class="col-md-6 col-xs-12">                                            
                                                    <input type="email" id="email" name="email" class="form-control" value="{{ $data->email }}">
                                                    <span id="errEmail"></span>
                                                </div>
                                            </div>                                   
                                           
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Mobile Number</label>
                                                <div class="col-md-6 col-xs-12">              
                                                    <input type="text" name="mobile" id="mobile" class="form-control" maxlength="10" value="{{ $data->contact_no }}"/>
                                                    <span id="errMobile" style="color:red"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">DOB</label>
                                                <div class="col-md-6 col-xs-12">              
                                                    <input type="date" name="dob" class="form-control" value="{{ $data->dob }}"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Gender</label>
                                                <div class="col-md-6 col-xs-12">                     
                                                   <select name="gender" class="form-control">
                                                      <option value="{{ $data->gender }}">{{ $data->gender }}</option>
                                                      <option value="male">Male</option>
                                                      <option value="female">Female</option>
                                                    </select>
                                                </div>                                            
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Image</label>
                                                <div class="col-md-6 col-xs-12">                      
                                                    <input type="file" class="fileinput btn-submit" name="image" id="filename" />
                                                    <input type="hidden" name="image_name" value="{{ $data->image}}">
                                                    <img src="{{ url('images/',$data->image)}}" class="img-thumbnail" width="80" height="80">
                                                </div>

                                            </div>

                                        </div>

                                        <div class="panel-footer" style="margin-top:20px;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="reset" class="btn btn-reset" value="Form Reset" style="margin:5px 0; max-width:300px; width:100%;">
                                                </div>                                   
                                                <div class="col-md-6">
                                                    <input type="submit" name="submit" value="Submit" class="btn btn-submit pull-right" style="max-width:300px; margin:2px 0; width:100%;">
                                                </div>                                    
                                            </div>                                   
                                        </div>
                                    
                                    </form>                         
                                </div>
                            </div>
                        </div>                    
                    </div>
                <!-- END PAGE CONTENT WRAPPER -->


@include('Admin.layout.footer')



 


    





