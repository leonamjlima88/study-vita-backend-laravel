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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120)->index();
            $table->string('reference_code', 36)->index()->nullable();
            $table->string('ean_code', 36)->index()->nullable();
            $table->decimal('cost_price', 15, 4)->nullable();
            $table->decimal('sale_price', 15, 4)->nullable();
            $table->decimal('minimum_quantity', 15, 4)->nullable();
            $table->decimal('current_quantity', 15, 4)->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('is_discontinued')->nullable();            
            $table->timestamps();
        });

        DB::table('product')->insert([
            ['name' => 'Headset Gamer HyperX Cloud Stinger', 'sale_price' => 199.90],
            ['name' => 'Mouse Gamer Redragon Cobra', 'sale_price' => 99.90],
            ['name' => 'Memória Corsair Vengeance LPX, 8GB, 2666MHz, DDR4', 'sale_price' => 214.90],
            ['name' => 'Processador Intel Core i3-10100F', 'sale_price' => 659.90],
        ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
