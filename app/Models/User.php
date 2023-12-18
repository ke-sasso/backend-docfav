<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ulid\Ulid;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use SoftDeletes;
    
    protected $keyType = 'ulid';
    protected $primaryKey = 'id';
    protected $table = 'testdocfav.users';
    protected $dateFormat = 'Y-m-d H:i:s';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'delete_at';
    public $incrementing = false; 

    protected $fillable = [
        'name',
        'email',
        'address',
        'phonenumber',
        'username'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'remember_token',
    ];


    public static function create($data)
    {
        $id=Ulid::generate();
        $user = new User();
        $user->id =$id;
        $user->name = $data['name'];
        $user->username =  $data['username'];
        $user->email = $data['email'];
        $user->address =  $data['address'];
        $user->phonenumber = $data['phonenumber'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->id =(string)$user->id;
        return $user;
    }

    public static function updatedata($id,$data)
    {
        $user =  User::find($id);
        if($data['name'] && $data['name']!='') $user->name =  $data['name'];
        if($data['email'] && $data['email']!='') $user->email = $data['email'];
        if($data['username'] && $data['username']!='') $user->username = $data['username'];
        $user->address =   $data['address'];
        $user->phonenumber = $data['phonenumber'];
        $user->save();
        return $user;
    }

    public static function deletedata($id)
    {

        $user =  User::find($id);
        $user->delete_at = date('Y-m-d');
        $user->save();
    }


    public static function emailval($id,$email)
    {
        return User::where('email',$email)->where('id','<>',$id)->count();
    }

    public static function usernamelval($id,$username)
    {
        return User::where('username',$username)->where('id','<>',$id)->count();
    }

}
