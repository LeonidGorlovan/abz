<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('additionally_id')
                ->after('id')
                ->constrained('user_additionallies')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('position_id')
                ->after('additionally_id')
                ->nullable()
                ->constrained('user_positions')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
