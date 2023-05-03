<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model
{
    use HasFactory;

    /**
     * The attributes that should be accepted in arrays.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'phone'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id','fname', 'lname', 'phone'];
}
