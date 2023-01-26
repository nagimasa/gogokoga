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
        Schema::create('reqruits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')
                ->constrained('services')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // １対多のリレーション設定
            $table->text('hero_image')->nullable();
            $table->text('reqruit_title');
            $table->text('reqruit_text');
            $table->text('work_type');
            $table->text('work_in_day')->nullable();
            $table->text('work_in_week')->nullable();
            $table->text('fee_type');
            $table->text('fee');
            $table->text('address');
            $table->text('another')->nullable();
            $table->text('maneger_name');
            $table->text('maneger_name_kana');
            $table->text('maneger_tel');
            $table->text('maneger_email')->nullable();
            $table->boolean('visualize');
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
        Schema::dropIfExists('reqruits');
    }
};
