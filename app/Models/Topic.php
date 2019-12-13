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

}
