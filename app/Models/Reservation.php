<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservations';

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
        'dateFrom',
        'dateTo',
        'price',
        'stroller_id',
        'user_id',
    ];

    public function stroller()
    {
        return $this->belongsTo(Stroller::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
