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
}
