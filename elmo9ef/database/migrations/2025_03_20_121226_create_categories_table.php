<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Vérifiez si la table 'categories' existe avant de la créer
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        // Vérifiez si la colonne 'category_id' n'existe pas déjà dans la table 'services'
        if (Schema::hasTable('services') && !Schema::hasColumn('services', 'category_id')) {
            Schema::table('services', function (Blueprint $table) {
                $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Supprimez la clé étrangère et la colonne 'category_id' de la table 'services'
        if (Schema::hasTable('services') && Schema::hasColumn('services', 'category_id')) {
            Schema::table('services', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }

        // Supprimez la table 'categories' si elle existe
        if (Schema::hasTable('categories')) {
            Schema::dropIfExists('categories');
        }
    }
}
