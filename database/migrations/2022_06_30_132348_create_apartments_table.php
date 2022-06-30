<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('rooms');
            $table->tinyInteger('bathrooms');
            $table->tinyInteger('beds');
            $table->smallInteger('mq');
            $table->string('address');
            $table->string('image');
            $table->text('description');
            $table->boolean('visibility');
            $table->decimal('latitude', 8, 5);
            $table->decimal('longitude', 8, 5 );
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
        Schema::dropIfExists('apartments');
    }
}
