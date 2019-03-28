<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 27/03/2019
 * Time: 16:07
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class MedicalRecordsAddStatus extends Migration
{
    public function up()
    {

        Schema::table('medical_records', function ($table) {
            $table->string('status');
        });
    }
}
