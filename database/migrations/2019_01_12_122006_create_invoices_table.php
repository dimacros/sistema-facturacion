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
            $table->char('serie', 4);
            $table->integer('correlative');
            $table->char('currency_code', 3); //Catalog. 02
            $table->date('creation_date');
            $table->date('expiration_date')->nullable();
            $table->string('status');
            $table->decimal('igv_percent', 4, 2);
            $table->decimal('subtotal', 8, 2)->default(0);
            $table->decimal('tax', 8, 2)->default(0);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);
            $table->string('sunat_operation_type'); //Catalog. 51
            $table->string('sunat_document_type'); //Catalog. 01
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('company_id');
            $table->timestamps();

            $table->foreign('customer_id')
                  ->references('id')->on('customers')
                  ->onDelete('cascade');

            $table->foreign('created_by')
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
