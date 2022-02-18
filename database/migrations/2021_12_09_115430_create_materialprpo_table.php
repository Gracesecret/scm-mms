<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialprpoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialprpo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('purchaserequisition_id');
            $table->unsignedBigInteger('purchaseorder_id');
            $table->integer('qty_pr');
            $table->integer('qty_po');
            $table->integer('qty_received');
            $table->integer('qty_pending');
            $table->integer('val_pr');
            $table->integer('val_po');
            $table->string('status');
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
        Schema::dropIfExists('materialprpo');
    }
}
