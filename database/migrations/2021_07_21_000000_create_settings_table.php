<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('website_title')->nullable();
                $table->text('website_logo_dark')->nullable();
                $table->text('website_logo_light')->nullable();
                $table->text('website_logo_small')->nullable();
                $table->string('website_favicon')->nullable();
    
                $table->string('meta_title')->nullable();
                $table->string('meta_description')->nullable();
                $table->string('meta_tag')->nullable();
    
                $table->foreignId('currency_id')->nullable()->constrained()->onDelete('set null');
    
                $table->text('address')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
    
                $table->string('facebook')->nullable();
                $table->string('twitter')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('instagram')->nullable();
                $table->string('github')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('settings');
    }
}
