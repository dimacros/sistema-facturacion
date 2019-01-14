<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('operation_type_code'); // Catalog. 51
            $table->string('document_type_code'); //Catalog. 01
            $table->char('serie', 4);
            $table->integer('correlative');
            $table->char('currency_code', 3); //Catalog. 02
            $table->date('creation_date');
            $table->date('expiration_date')->nullable();
            $table->unsignedInteger('customer_id');
            $table->string('status');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('igv_percent', 4, 2);
            $table->decimal('tax', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('total', 8, 2);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('company_id');
            $table->timestamps();

            $table->foreign('customer_id')
                  ->references('id')->on('customers')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('company_id')
                  ->references('id')->on('companies')
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
        Schema::dropIfExists('invoices');
    }
}
