<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_name_ar');
            $table->string('employee_name_en');
            $table->Integer('restaurant_id')->unsigned();   
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->enum('gender',['male','female','other'])->default('other');
            $table->string('position');
            $table->decimal('salary', 5, 2)->default(0);
            $table->string('phonenumber');
            $table->string('employee_image')->nullable();
            $table->longtext('other_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
