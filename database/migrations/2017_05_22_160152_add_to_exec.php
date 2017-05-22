<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToExec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exec', function (Blueprint $table) {

          
            $table->string('monday');
            $table->string('tues');
            $table->string('wends');
            $table->string('thurs');
            $table->string('fri');
            $table->string('highest');
            $table->string('lowestaverage');
            $table->string('saving');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
