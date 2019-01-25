<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class learn extends Model
{
	protected $table = 'customer';
    protected $fillable = ['name','email','password','authToken','contact_no','gender','dob','image'];
    
    use SoftDeletes;    
    protected $dates = ['delete_at'];
    
}
