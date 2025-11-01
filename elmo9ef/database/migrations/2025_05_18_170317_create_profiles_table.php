<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void {
Schema::create('profiles', function (Blueprint $table) {
$table->id();
$table->foreignId('tasker_id')->constrained()->onDelete('cascade');
$table->string('cover')->nullable(); // image de couverture
$table->integer('rating')->default(0); // nombre d’étoiles
$table->text('a_propos')->nullable(); // texte "à propos"
$table->text('commentaire')->nullable(); // commentaire
$table->timestamps();
});
}


public function down(): void {
    Schema::dropIfExists('profiles');
}
};
