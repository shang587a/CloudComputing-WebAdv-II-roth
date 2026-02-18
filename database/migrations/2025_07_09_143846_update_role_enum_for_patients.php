<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor', 'patient') DEFAULT 'patient'");
}

public function down()
{
    DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'doctor') DEFAULT 'doctor'");
}
};
