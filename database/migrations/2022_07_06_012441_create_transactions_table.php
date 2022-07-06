<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('midtran_id')->nullable();
            $table->unsignedBigInteger('cost_id')->nullable();
            $table->enum('jenis_pembayaran', ["OFFLINE", "ONLINE"])->default("OFFLINE");
            $table->enum('status', ["PENDING", "SUCCESS", "FAILED"])->default("PENDING");
            $table->date('tanggal_bayar')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
