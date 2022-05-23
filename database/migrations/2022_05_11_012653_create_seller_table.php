<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('seller', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->index();
            $table->string('ein', 20)->unique()->index();
            $table->text('note')->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('address_number', 15)->nullable();
            $table->string('complement', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('reference_point', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });

        // Poderia ter utilizado a factory, porém como não sei gerar cpf/cnpj válidos aleatórios, decidi fazer assim mesmo
        DB::table('seller')->insert([
            ['name' => 'Vend. Maria Clara', 'ein' => '08776810000146'],
            ['name' => 'Vend. Sophia', 'ein' => '34644477000121'],
            ['name' => 'Vend. Roberto', 'ein' => '35176034000116'],
        ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller');
    }
};
