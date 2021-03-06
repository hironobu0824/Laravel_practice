<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
     
    public function up()
    {
        // if (Schema::hasTable('users')) {
        //     // テーブルが存在していればリターン
        //     return;
        // }     
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('post_id')->unsigned();
            $table->biginteger('user_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // userが削除されたとき、それに関連するlikeも一気に削除される

            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('cascade'); // postが削除されたとき、それに関連するlikeも一気に削除される
            
            $table->unique(['user_id','post_id']);      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
