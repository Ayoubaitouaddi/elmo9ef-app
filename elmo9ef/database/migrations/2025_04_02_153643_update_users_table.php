    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class UpdateUsersTable extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('name');
                $table->string('first_name')->after('id');
                $table->string('last_name')->after('first_name');
                $table->string('phone')->nullable()->after('email');
                $table->string('code_postal')->nullable()->after('phone');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['first_name', 'last_name', 'phone', 'code_postal']);
            });
        }
    }
