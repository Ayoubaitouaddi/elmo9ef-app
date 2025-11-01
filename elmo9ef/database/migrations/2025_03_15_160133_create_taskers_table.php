<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskersTable extends Migration
{
    public function up()
    {
        Schema::create('taskers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Clé étrangère vers la table users
            $table->string('nom');
            $table->string('prenom');
            $table->string('CIN');
            $table->string('category_name')->nullable();
            $table->string('service_name')->nullable();
            $table->string('image')->nullable();
            $table->string('adresse');
            $table->string('telephone');
            $table->timestamps();

            // Définir la clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('taskers');
    }
}
