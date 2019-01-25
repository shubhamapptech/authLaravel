
@include('Admin.layout.header',['page'=>'two'])
<!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add </strong> Customer</h3>
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
                                                         
                                    <form method="post" action="{{ url('/save_customer') }}" class="form-horizontal" enctype="multipart/form-data" id="jvalidate" name="frm">
                                     {{ csrf_field() }}
                                        <div class="panel-body form-group-separated">

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Name</label>
                                                <div class="col-md-6 col-xs-12">
                                                        <input type="text" name="name" class="form-control" > 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">E-mail</label>
                                                <div class="col-md-6 col-xs-12">                                            
                                                    <input type="email" id="email" name="email" class="form-control">
                                                    <span id="errEmail"></span>
                                                </div>
                                            </div>                                   

                                            <div class="form-group">                                        
                                                <label class="col-md-3 col-xs-12 control-label">Password</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="password" id="password1" name="password" class="form-control" minlength="5" />
                                                </div>
                                            </div>


                                            <div class="form-group">            
                                                <label class="col-md-3 col-xs-12 control-label">Confirm Password</label>
                                                <div class="col-md-6 col-xs-12">                                            
                                                    <input type="password" name="confirm_password" class="form-control"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Mobile Number</label>
                                                <div class="col-md-6 col-xs-12">              
                                                    <input type="text" name="mobile" id="mobile" class="form-control" maxlength="10"/>
                                                    <span id="errMobile" style="color:red"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">DOB</label>
                                                <div class="col-md-6 col-xs-12">              
                                                    <input type="date" name="dob" class="form-control"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Gender</label>
                                                <div class="col-md-6 col-xs-12">                     
                                                   <select name="gender" class="form-control">
                                                      <option value="">Select</option>
                                                      <option value="male">Male</option>
                                                      <option value="female">Female</option>
                                                    </select>
                                                </div>                                            
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Image</label>
                                                <div class="col-md-6 col-xs-12">                      
                                                    <input type="file" class="fileinput btn-submit" name="image" id="filename" />
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



 


    





