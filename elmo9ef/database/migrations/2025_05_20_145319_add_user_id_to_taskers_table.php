<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTaskersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taskers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Ajoute la colonne user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Définit la clé étrangère
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taskers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
