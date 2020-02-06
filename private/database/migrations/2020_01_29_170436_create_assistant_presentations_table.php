<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantPresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_presentation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            
            $table->bigIncrements('id');
            $table->bigInteger('id_assistant')->unsigned();
            $table->bigInteger('id_presentation')->unsigned();
            $table->boolean('paid_out')->default(0);
            $table->string('document')->default(null);
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_assistant')->references('id')->on('users');
            $table->foreign('id_presentation')->references('id')->on('presentation');
            
            $table->unique(['id_assistant', 'id_presentation']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assistant_presentation');
    }
}
