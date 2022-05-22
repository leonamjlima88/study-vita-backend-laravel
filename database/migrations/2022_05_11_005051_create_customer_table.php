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
