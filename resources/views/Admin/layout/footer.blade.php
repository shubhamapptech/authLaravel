			</div>  
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
<!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p style="color: white !important;">Are you sure you want to log out?</p>                    
                        <p style="color: white !important;">Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ route('logout') }}" class="btn btn-success btn-lg"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <ul class="dropdown-menu">
                                     










        <!-- END MESSAGE BOX-->
        <!--Autocomplete script-->      
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- <script>
         $(document).ready(function(){
            $("#tag").keyup(function(){ 
                $("#tag").autocomplete({
                source:"http://app.repillrx.com/medical/index.php/PrescriptionControler/search_company/?"
                });
            });            

            $("#medicine").autocomplete({
                source:"http://app.repillrx.com/medical/index.php/PrescriptionControler/search_medicine/?"
            });
         });
        </script> -->
        <!--Auto Complete Script end-->
        <!-- START PRELOADS -->
        
        
        <audio id="audio-alert" src="{{ asset('Admin_assest/audio/alert.mp3')}}" preload="auto"></audio>
        <audio id="audio-alert" src="{{ asset('Admin_assest/audio/fail.mp3')}}" preload="auto"></audio>

        
        <!-- END PRELOADS -->                      
        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/jquery/jquery-ui.min.js')}}"></script>        
        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/bootstrap/bootstrap.min.js')}}"></script>              
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>      
        <!-- END PLUGINS -->
        <!-- START THIS PAGE PLUGINS-->               
        
        <script type='text/javascript' src="{{ asset('Admin_assest/js/plugins/icheck/icheck.min.js')}}"></script>
        <script type='text/javascript' src="{{ asset('Admin_assest/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        <script type='text/javascript' src="{{ asset('Admin_assest/js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>

        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/bootstrap/bootstrap-select.js') }}"></script>
        
        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/bootstrap/bootstrap-timepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
        <!-- END THIS PAGE PLUGINS-->  
        
        <script type='text/javascript' src="{{ asset('Admin_assest/js/plugins/jquery-validation/jquery.validate.js') }}"></script> 
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

        <script type='text/javascript' src="{{ asset('Admin_assest/js/formValidationScript.js') }}"></script> 
           
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{ asset('Admin_assest/js/settings.js') }} "></script>
        <script type="text/javascript" src="{{ asset('Admin_assest/js/plugins.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('Admin_assest/js/actions.js') }}"></script> 
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->    
    </body>
</html>







































        