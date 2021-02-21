<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairGuarantee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_guarantee', function (Blueprint $table) {
                 
            $table->increments('id');

            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')
                    ->references('id')->on('business')
                    ->onDelete('cascade');

            $table->integer('location_id')
                ->nullable()->unsigned();

            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')
                    ->references('id')->on('contacts')
                    ->onDelete('cascade');

            $table->string('job_sheet_no');
            $table->enum('service_type', ['carry_in', 'pick_up', 'on_site']);

            $table->text('pick_up_on_site_addr')
                ->nullable();
                
            $table->integer('variation_id')
                ->nullable()->unsigned();
          

            $table->integer('transaction_id')
                ->nullable()->unsigned();
           

            $table->integer('supplier_id')
                ->nullable()->unsigned();
           
            $table->text('checklist')->nullable();

            $table->string('security_pwd')
                ->nullable();

            $table->string('security_pattern')
                ->nullable();

            $table->string('serial_no');

            $table->integer('status_id');

            $table->dateTime('delivery_date')
                ->nullable();
            
            $table->text('product_configuration')
                ->nullable();

            $table->text('defects')
                ->nullable();

            $table->text('product_condition')
                ->nullable();

            $table->integer('service_staff')
                ->nullable()->unsigned();
            $table->foreign('service_staff')
                ->references('id')->on('users');

            $table->text('comment_by_ss')
                ->comment('comment made by technician')
                ->nullable();

            $table->decimal('estimated_cost', 22, 4)
                ->nullable();

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')->on('users');

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
        Schema::dropIfExists('repair_guarantee');
    }
}
