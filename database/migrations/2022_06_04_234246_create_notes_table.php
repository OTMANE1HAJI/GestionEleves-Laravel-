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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('code_eleve')
            ->constrained('eleves')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('code_elm_module')
            ->constrained('element_modules')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->float('note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
