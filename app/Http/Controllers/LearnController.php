<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\learn;

use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class LearnController extends Controller
{
    public function signup(request $request){    	
    	$Validator = $request->validate([
        	'name' => 'required|max:255',
        	'email' => 'required|email|unique:customer',
        	'password'=>'required',        	
        	'contact_no'=>'required|integer',
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
    	if(learn::create(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password),'contact_no'=>$request->contact_no,'authToken'=>$authToken,'gender'=>$request->gender,'dob'=>$request->dob,'image'=>$imageName])){
    	   return response(['status'=>true,'message'=>'success','data'=>$Validator]);    	            
        }
        else{
            return response(['status'=>false,'message'=>'Something went wrong','data'=>array()]);
        }
    }

    public function login(request $request){
    	$Validator   = $request->validate(['email'=>'required|email','password'=>'required']);
        $user = DB::table('customer')->where('email',$request->email)->get()->toArray();           
        if(!empty($user)){  
            $id = $user[0]->id;     
            $password = $user[0]->password;
            if(Hash::check(request()->password,$password)){
                $authToken = $this->generateAuthToken();
                $user[0]->authToken = $authToken;
                DB::table('customer')->where(['id'=>$id])->update(['authToken' =>$authToken]);
                return response(['status'=>true,'message'=>'success','data'=>$user]);
            }
            else{
                return response(['status'=>false,'message'=>'Password does not match','data'=>'']);
            }
        }
        else{
            return response(['status'=>false,'message'=>'Invalid email','data'=>'']);
        } 
    }

    public function getProfile(request $request){
        //print_r(request()->method());die();
        $Validator = $request->validate(['token'=>'required']);
        $userdata = DB::table('customer')->where(['authToken'=>request()->token])->get()->toArray();        
        if(!empty($userdata)){
            $userdata = $this->keyChange($userdata);            
            return response(['status'=>true,'message'=>'success','data'=>$userdata]);
        }
        else{
            return response(['status'=>false,'message'=>'Invalid token','data'=>$userdata]);   
        }                        
    }

    public function getAllRecords(request $request){
        //print_r(request()->method());die();
        //$Validator = $request->validate(['tag'=>'required']);
        $userdata = DB::table('customer')->get()->toArray();        
        if(!empty($userdata)){
            $userdata = $this->keyChange($userdata);            
            return response(['status'=>true,'message'=>'success','data'=>$userdata]);
        }
        else{
            return response(['status'=>false,'message'=>'Invalid token','data'=>$userdata]);   
        }                        
    }

    public function updateRecord(request $request){ 
        $validator = $request->validate([
            'token'=>'required',
            'name' => 'required|max:255',            
            'contact_no'=>'required|integer',
            'gender'=>'required',
            'dob'=>'required|date',
            //'mobile' => 'required|max:18|min:8|unique:drivers,mobile,'.decrypt($request->id).',id,deleted_at,'.$empty,
            'email' => 'required|email|unique:customer,email,'.decrypt(request()->token).',id',
            //'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $userdata = DB::table('customer')->where(['authToken'=>request()->token])->get()->toArray();        
        
        if(!empty($userdata)){
            $imageName = $userdata[0]->image;
            if(isset(request()->image)){            
                $image     = request()->image->getClientOriginalName();
                $imageName = time().$image;
                //return response(['imagename'=>$imageName]);die();
                request()->image->move(public_path('images'), $imageName);
            }    
            if(DB::table('customer')->where(['authToken'=>request()->token])->update(['name' =>request()->name,'image'=>$imageName,'contact_no'=>request()->contact_no,'gender'=>request()->gender,'dob'=>request()->dob])){
                $userdata = DB::table('customer')->where(['authToken'=>request()->token])->get()->toArray();
                $userdata = $this->keyChange($userdata);
                return response(['status'=>true,'message'=>'success','data'=>$userdata]);
            }
            else{
                $userdata = $this->keyChange($userdata);
                return response(['status'=>false,'message'=>'Something went wrong','data'=>$userdata]);       
            }
        }
        else{
            return response(['status'=>false,'message'=>'Invalid user','data'=>$userdata]);   
        }
    }

    public function save_multiple_image(request $request){
        //return  'hii';
        //return request()->images;die();
        if(request()->hasfile('images')){            
            foreach ($request->file('images') as $file) {
                $image = $file->getClientOriginalName();
                $imageName[] = time().$image;    
            }
            $images = serialize($imageName);
            DB::table('images')->insert(array('images'=>$images));
            return response(['images'=>$images]);
        }
        else{
            return response(['status'=>false,'message'=>'Please select image']);   
        }
    }

    public function get_images(request $request){
        $data = DB::table('images')->get()->toArray();
        foreach ($data as $key) {
            //print_r($key->images);die();
            $images[] = unserialize($key->images);
        }
        foreach ($images as $k) {
            //return $k;
        }
        return response(['images'=>$images]);
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
