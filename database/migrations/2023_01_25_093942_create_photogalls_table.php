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
        Schema::create('photogalls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')
            ->constrained('services')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // １対多のリレーション設定
            $table->text('image_name');
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
        Schema::dropIfExists('photogalls');
    }
};