<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            // 'title, description, extract, price, hour, video_url, id_congress, id_speaker, edited'
            $table->bigIncrements('id');
            $table->string('title', 100)->unique();
            $table->longText('description');
            $table->string('extract', 200);
            $table->decimal('price', 8, 2);
            $table->string('hour');
            $table->string('video_url')->nullable();
            $table->bigInteger('id_congress')->unsigned()->nullable(false);
            $table->bigInteger('id_speaker')->unsigned()->nullable(false);
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_congress')->references('id')->on('congress');
            $table->foreign('id_speaker')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentation');
    }
}
