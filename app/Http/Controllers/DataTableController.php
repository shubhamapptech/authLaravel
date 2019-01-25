<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use DataTables;
use App\User;
use DB;

class DataTableController extends Controller
{
    /*public function index()
    {  
       $data['countries'] = Country::select('id' , 'name')->orderBy('name')->get();

       $data['roles']     = Role::select('id' , 'name')->where('status'  , '=' , '1')->orderBy('name')->get();

       return view('admin.adminUsers.index' , compact('data' , 'admins'));
    }*/

   /**
    * Get the datatable Dataif of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    /*public function getDatatableData(Request $request){           
        $admins =  DB::table('admins')
                    ->select('admins.id' , 'admins.first_name' , 'admins.last_name' , 'admins.email' ,'admins.mobile' , 'admins.is_active' , 'countries.name as country_name')
                    ->leftJoin('countries' , 'countries.id' , '=' ,'admins.country_id')
                    ->get();

        return datatables()->of($admins)->editColumn('name', function ($admins) {
            return  $admins->first_name.' '.$admins->last_name;
        })->make(true);
    }*/



    public function datatable()
    {
        return view('datatable');
    }

    public function getPosts()
    {
        $users = DB::table('customer')->select('*');
        return Datatables::of($users)->make(true);
    }

    public function getPostsS()
    {
        $users = DB::table('customer')->select('*');
        echo json_encode($users);
        //return \DataTables::of($users)->make(true);
    }

    public function datatCiti()
    {
        return view('Admin.city');
    }

    public function getcities()
    {
        $users = DB::table('cities')->select('*');
        return Datatables::of($users)->make(true);
    }
    

    
}
