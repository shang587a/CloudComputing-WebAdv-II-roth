<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

// class Doctor extends Model
// {
//     protected $table = 'doctor'; //table name
//     protected $primaryKey = 'doctor_id'; //ID of the table

//     protected $fillable = [
//     'doctor_name',
//     'email',
//     'password',
//     'gender',
//     'contact_number',
//     'specialized_id',
//     'admin_id',
// ];
// }


class Doctor extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'doctor'; // your table name

    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'doctor_name',
        'email',
        'password',
        'gender',
        'contact_number',
        // 'specialized_id',
        // 'admin_id',
    ];

    protected $hidden = [
        'password',
    ];
}