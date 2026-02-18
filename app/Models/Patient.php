<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient'; //table name
    protected $primaryKey = 'patient_id'; //ID of the table
}
