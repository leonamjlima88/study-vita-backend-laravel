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
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->string('business_name', 80)->index();
            $table->string('alias_name', 80)->index();
            $table->string('ein', 20)->unique()->index();
            $table->string('state_registration', 20)->nullable();
            $table->tinyInteger('is_icms_taxpayer')->nullable()->comment('[0=false, 1=true]');
            $table->string('municipal_registration', 20)->nullable();
            $table->text('note')->nullable();
            $table->string('internet_page', 255)->nullable();
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
        DB::table('customer')->insert([
            ['business_name' => 'Miguel', 'alias_name' => 'Miguel', 'ein' => '21060740000193'],
            ['business_name' => 'Arthur', 'alias_name' => 'Arthur', 'ein' => '73765276000134'],
            ['business_name' => 'Gael', 'alias_name' => 'Gael', 'ein' => '27711147000146'],
            ['business_name' => 'Heitor', 'alias_name' => 'Heitor', 'ein' => '68352058000138'],
            ['business_name' => 'Helena', 'alias_name' => 'Helena', 'ein' => '40533586000174'],
            ['business_name' => 'Alice', 'alias_name' => 'Alice', 'ein' => '24066441000154'],
            ['business_name' => 'Theo', 'alias_name' => 'Theo', 'ein' => '31832821000118'],
            ['business_name' => 'Laura', 'alias_name' => 'Laura', 'ein' => '26437121000199'],
            ['business_name' => 'Davi', 'alias_name' => 'Davi', 'ein' => '25730747000126'],
            ['business_name' => 'Gabriel', 'alias_name' => 'Gabriel', 'ein' => '52218584000170'],
            ['business_name' => 'Valentina', 'alias_name' => 'Valentina', 'ein' => '30437066000104'],
            ['business_name' => 'Heloísa', 'alias_name' => 'Heloísa', 'ein' => '55725781000173'],
        ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
};
