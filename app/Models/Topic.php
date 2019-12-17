<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user_id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 */
class Topic extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'content', 'created_at', 'updated_at'];

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
            return Comment::where('topic_id','=',$model->id)->delete();

        });
    }

}
