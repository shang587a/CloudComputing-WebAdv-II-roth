<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Note the change here
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

// class Admin extends Model
// {
//     protected $table = 'admin'; //table name
//     protected $primaryKey = 'admin_id'; //ID of the table
// }

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'admin'; // your table name
    protected $primaryKey = 'admin_id';

    // Fields allowed for mass assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'doctor_id', // if needed
    ];

    // Hide sensitive fields from JSON output
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast attributes
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
