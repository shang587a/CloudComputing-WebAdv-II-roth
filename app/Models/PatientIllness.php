<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientIllness extends Model
{
    protected $table = 'patient_illness'; //table name
    protected $primaryKey = 'patient_illness_id'; //ID of the table
}
