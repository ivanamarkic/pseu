<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('smijer_id')->nullable();

            $table->foreign('smijer_id', 'smijer_fk_598776')->references('id')->on('smijerovi');
        });
    }
}
