<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionsMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections_mapping', function (Blueprint $table) {
            $table->id();
            $table->string("asaas_office_id")->unique();
            $table->string("maintenance_db_name")->unique();
            $table->string("account_name");
            $table->string("account_logo")->nullable();
            $table->string("subdomain")->nullable();
            $table->string("domain")->nullable();
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
        Schema::dropIfExists('connections_mapping');
    }
}
