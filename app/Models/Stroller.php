<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stroller extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stroller';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'model',
        'type',
        'year',
        'weight',
        'max_weight',
        'description',
        'price',
        'image',
    ];
}
