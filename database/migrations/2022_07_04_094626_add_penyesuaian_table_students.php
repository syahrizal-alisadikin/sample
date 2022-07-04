<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenyesuaianTableStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('nisn')->nullable();
            $table->unsignedBigInteger('room_id')->after('user_id')->nullable();
            $table->unsignedBigInteger('school_years_id')->after('room_id')->nullable();

            $table->foreign('school_years_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn("user_id");
            $table->dropColumn("room_id");
            $table->dropColumn("school_years_id");
        });
    }
}
