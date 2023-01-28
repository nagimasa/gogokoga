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
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')
            ->constrained('services')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // １対多のリレーション設定
            $table->string('name');
            $table->string('name_kana')->nullable();
            $table->string('email')->unique();
            $table->string('owner_tel')->unique()->nullable();
            $table->string('another')->nullable();
            $table->boolean('paid')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
};
