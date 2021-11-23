<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cms_pages')) {
            Schema::create('cms_pages', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->boolean('status')->default(0);
                $table->timestamps();

                $table->biginteger('cat_id')->unsigned()->nullable();
                $table->foreign('cat_id')->references('id')->on('cms_categories')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_pages');
    }
}
