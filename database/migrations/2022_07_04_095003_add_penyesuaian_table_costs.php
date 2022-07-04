<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenyesuaianTableCosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('costs', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->after('name')->nullable();
            $table->unsignedBigInteger('midtran_id')->after('student_id')->nullable();
            $table->unsignedBigInteger('tagihan_id')->after('midtran_id')->nullable();
            $table->enum('status', ["PENDING", "SUCCESS", "FAILED"])->default("PENDING");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('costs', function (Blueprint $table) {
            $table->dropColumn("student_id");
            $table->dropColumn("midtran_id");
            $table->dropColumn("tagihan_id");
            $table->dropColumn("status");
        });
    }
}
