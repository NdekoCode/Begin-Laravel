<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAvatarOnUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // On veut mettre à jour la table `users`
        Schema::table('users', function (Blueprint $table) {
            // Pour dire que cette colonne peut etre null
            $table->string('avatar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Pour dire que cette colonne peut etre null
            $table->dropColumn('avatar');
        });
    }
}
