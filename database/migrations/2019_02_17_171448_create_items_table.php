<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('description')->nullable();

            $table->Integer('restaurant_id')->unsigned()->nullable();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

            $table->Integer('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->Integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('photo')->nullable();

            $table->decimal('price', 5, 2)->default(0);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->decimal('price_offer', 5, 2)->default(0);
            $table->date('start_offer_at')->nullable();
            $table->date('end_offer_at')->nullable();


            $table->enum('is_public',['yes','no'])->default('yes');
            $table->longtext('reason')->nullable();

            $table->longtext('other_data')->nullable();
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
        Schema::dropIfExists('items');
    }
}
