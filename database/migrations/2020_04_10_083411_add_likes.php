<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('articles', function (Blueprint $table) {

          $table->integer('likes_count')->default(0);
          $table->integer('views_count')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('articles', function (Blueprint $table) {
          $table->dropColumn('likes_count');
          $table->dropColumn('views_count');
      });
    }
}
