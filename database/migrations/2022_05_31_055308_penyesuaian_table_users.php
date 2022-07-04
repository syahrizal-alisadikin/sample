<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Expr\Cast\String_;

class PenyesuaianTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('users', function (Blueprint $table) {
            $table->string("username")->unique();
            $table->enum('roles', ["SISWA", "ADMIN", "STAFF"])->default("SISWA");
            $table->string("avatar")->nullable();
            $table->enum("status", ["ACTIVE", "INACTIVE"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('users', function (Blueprint $table) {
            $table->dropColumn("username");
            $table->dropColumn("roles");
            $table->dropColumn("avatar");
            $table->dropColumn("status");
        });
    }
}
