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
        Schema::create('element_modules', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('designation');
            $table->Integer('VH');
            $table->float('poids');
            $table->foreignId('code_module')
            ->constrained('modules')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('element_modules');
    }
};
