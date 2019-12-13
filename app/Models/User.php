<?php

namespace App\Models;

use function foo\func;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($model){
            /**
             * 这里可以处理相应的业务
             * 例如：权限检查
             */
//            $data = Profile::where('user_id',$model->id)->get();

//            var_dump($data);exit;
        });

        static::deleted(function ($model){

            /**
             * 这里可以处理相应的业务
             * 例如：关联数据删除
             */
            return Profile::where('user_id','=',$model->id)->delete();

        });
    }

}
