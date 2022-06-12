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
        Schema::create('moyennes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('code_eleve')
            ->constrained('eleves')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('code_fil')
            ->constrained('filieres')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('niveau');
            $table->float('moyenne');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moyennes');
    }
};
