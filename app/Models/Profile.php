<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user_id
 * @property string $age
 * @property string $gender
 * @property string $created_at
 * @property string $updated_at
 */
class Profile extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'age', 'gender', 'created_at', 'updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
