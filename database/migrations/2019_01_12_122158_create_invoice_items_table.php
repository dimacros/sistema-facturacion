<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->char('code', 4);
            $table->string('description');
            $table->integer('quantity');
            $table->decimal('price');
            $table->char('tax_exemption_reason_code', 2); //Catalog. 07
            $table->unsignedInteger('invoice_id');
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('id')->on('products')
                  ->onUpdate('cascade');
                  
            $table->foreign('invoice_id')
                  ->references('id')->on('invoices')
                  ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
