<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $topic_id
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['topic_id', 'content', 'created_at', 'updated_at','user_id'];

    public function Topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
