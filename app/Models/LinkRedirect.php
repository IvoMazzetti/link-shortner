<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LinkRedirect extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'redirect_from',
        'redirect_to',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function getYourDatetimeColumnAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
