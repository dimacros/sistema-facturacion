<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('quantity');
            $table->timestamp('movement_verified_at')->nullable();
            $table->unsignedInteger('inventory_id');
            $table->unsignedInteger('created_by');
            $table->timestamps();

            $table->foreign('inventory_id')
                  ->references('id')->on('inventories')
                  ->onDelete('cascade');

            $table->foreign('created_by')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_movements');
    }
}
