<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $director
 * @property string $describe
 * @property boolean $rate
 * @property string $release_at
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $released
 */
class Movie extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'director', 'describe', 'rate', 'release_at', 'created_at', 'updated_at', 'released'];

}
