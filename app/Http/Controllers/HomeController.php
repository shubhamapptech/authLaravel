<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\learn;

use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('Admin.add_customer');
    }

    public function add_customer(){
        return view('Admin.add_customer');
    }

    public function save_customer(request $request){
        $Validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customer',
            'password'=>'required',         
            'mobile'=>'required|integer',
            'gender'=>'required',
            'dob'=>'required|date',
            //'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $imageName ='default.jpg';
        if(isset(request()->image)){            
            $image     = request()->image->getClientOriginalName();
            $imageName = time().$image;
            //return response(['imagename'=>$imageName]);die();
            request()->image->move(public_path('images'), $imageName);
        }
        $authToken = $this->generateAuthToken();
        if(learn::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password),'contact_no'=>$request->mobile,'authToken'=>$authToken,'gender'=>$request->gender,'dob'=>$request->dob,'image'=>$imageName])){

            return back()->with('msg','Record has been successfully saved')->with('color','success');
           //return response(['status'=>true,'message'=>'success','data'=>$Validator]);                   
        }
        else{
            return back()->with('msg','Something went wrong. Please try again')->with('color','warning');
            //return response(['status'=>false,'message'=>'Something went wrong','data'=>array()]);
        }
    }

    public function mycustomers(){        
        $customers = DB::table('customer')->where('deleted_at',null)->paginate(8);        
        if(!empty($customers)){            
            return view('Admin.customer',compact('customers'));
            //return response(['status'=>true,'message'=>'success','data'=>$userdata]);
        }
        else{
            return view('Admin.customer',compact('customers'))->with('msg','No record found');
            //return response(['status'=>false,'message'=>'Invalid token','data'=>$userdata]);   
        }  
    }

    public function mycustomer_search(request $request){    
        if(request()->q==''){
            return redirect('mycustomers');
        }
        $search = request()->q;    
        $customers = DB::table('customer')
                    ->where('deleted_at',null)
                    ->orWhereRaw('name like ?','%'.strtolower($search).'%')
                    ->orWhereRaw('email like ?','%'.strtolower($search).'%')
                    ->orWhereRaw('contact_no like ?','%'.strtolower($search).'%')
                    ->paginate(8);           
        if(!empty($customers[0])){                      
            return view('Admin.customer',compact('customers'))->with('query',$search);            
        }
        else{
            return view('Admin.customer',compact('customers'))->with(['error'=>1,'message'=>'No record found','query'=>$search]);            
        }  
    }

    

    public function set_status(request $request){
        $id = request()->customer_id;
        $preStatus = DB::table('customer')->where('id',$id)->first();
        //echo json_encode($preStatus);die();
        if(!empty($preStatus)){
            if($preStatus->is_active==0){
                $new_status = 1;
            }
            elseif($preStatus->is_active==1){
                $new_status = 0;
            }
            else{
                $response = array('status'=>'false','message'=>'Invalid request');
                echo json_encode($response);die();
            }
            if(DB::table('customer')->where('id',$id)->update(array('is_active'=>$new_status))){
                $response = array('status'=>'true','new_status'=>$new_status,'message'=>'Status has been successfully changed');
                echo json_encode($response);
            }
            else{
                $response = array('status'=>'false','message'=>'Something went wrong, Please try again');
                echo json_encode($response);   
            }
        }
    }

    public function edit_customer(request $request){
        $id = decrypt(request()->id);
        if($id!=''){
            $data = DB::table('customer')->where('id',$id)->first(); 
            return view('Admin.update_customer',compact('data','id'));     
        }
        else{
            return back()->with('message','Something went wrong');
        }        
    }

    public function update_customer(request $request){
        $id = decrypt(request()->id);
        $method = $request->method();
            
            $validator = $request->validate([           
                'name' => 'required|max:255',            
                'mobile'=>'required|integer',
                'gender'=>'required',
                'dob'=>'required|date',
                //'mobile' => 'required|max:18|min:8|unique:drivers,mobile,'.decrypt($request->id).',id,deleted_at,'.$empty,
                'email' => 'required|email|unique:customer,email,'.$id.',id',
                //'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

        //print_r($method);die();        
            $data = DB::table('customer')->where(['id'=>$id])->first();        
            if(!empty($data)){
                $imageName = $data->image;
                if(isset(request()->image)){            
                    $image     = request()->image->getClientOriginalName();
                    $imageName = time().$image;
                    //return response(['imagename'=>$imageName]);die();
                    request()->image->move(public_path('images'), $imageName);
                }    
                if(DB::table('customer')->where(['id'=>$id])->update(['name' =>request()->name,'image'=>$imageName,'contact_no'=>request()->mobile,'gender'=>request()->gender,'dob'=>request()->dob])){
                    $data = DB::table('customer')->where(['id'=>$id])->first(); 
                    return view('Admin.update_customer',compact('data','id'))->with(['success'=>1,'message'=>'Record has been successfully udpate']);
                }
                else{                    
                    return view('Admin.update_customer',compact('data','id'))->with(['error'=>1,'message'=>'Oops! Something went wrong, Please try again']);
                }
            }
            else{
                echo 'yes';die();
                return back()->with(['error'=>1,'message'=>'Invalid user']);            
            }
       
    }

    public function delete_customer(request $request){
        $id = request()->id;

        if(learn::withTrashed()->where('id',$id)->delete()){
            //echo 'hii';die();
            return back()->with(['success'=>1,'message'=>'Record has been successfully deleted']);
        }    
        else{
            //echo 'heloo';die();
            return back()->with(['error'=>1,'message'=>'Oops! Something went wrong. Please try again']);
        }
    }

    


    public function keyChange($data){
        foreach($data as $key => $value) {                
            if(isset($value->password)){
                unset($value->password);
            } 
            if(isset($value->authToken)){
                unset($value->authToken);
            }  
            if(isset($value->image)){
                $value->image= url('/images/'.$value->image);
            }            
        }    
        return $data;
    }
   

    public function generateAuthToken($length = 20) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
}
