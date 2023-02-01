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
        Schema::create('tag_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('tags'); // 多対多のリレーション設定
            $table->foreignId('service_id')->constrained('services'); // 多対多のリレーション設定
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
        Schema::dropIfExists('tag_service');
    }
};
