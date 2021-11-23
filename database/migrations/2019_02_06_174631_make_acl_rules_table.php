<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeAclRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('acl_rules')) {
            Schema::create('acl_rules', function (Blueprint $table) {
                $table->increments('id');
                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->string('disk');
                $table->string('path');
                $table->tinyInteger('access');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('acl_rules');
    }
}
