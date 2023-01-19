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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained('genres'); // １対多のリレーション設定
            $table->foreignId('area_id')->constrained('areas'); // １対多のリレーション設定
            $table->string('service_name');
            $table->string('service_name_kana');
            $table->string('email')->nullable();
            $table->string('tel')->nullable();
            $table->string('address')->nullable();
            $table->string('parking')->nullable();
            $table->string('url')->nullable();
            $table->string('googlemap')->nullable();
            $table->boolean('visualize')->default(1);
            $table->string('another')->nullable();
            $table->boolean('takeout')->nullable();
            $table->string('seat')->nullable();
            $table->string('first_fee')->nullable();
            $table->string('add_fee')->nullable();
            $table->string('stay_fee')->nullable();
            $table->string('cancel_fee')->nullable();
            $table->string('sunday')->nullable();
            $table->string('monday')->nullable();
            $table->string('tuesday')->nullable();
            $table->string('wednesday')->nullable();
            $table->string('thursday')->nullable();        
            $table->string('friday')->nullable();    
            $table->string('saturday')->nullable();
            $table->string('regular_holiday')->nullable();
                        
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
        Schema::dropIfExists('services');
    }
};