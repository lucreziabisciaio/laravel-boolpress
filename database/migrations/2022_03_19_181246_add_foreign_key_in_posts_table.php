<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger("user_id")
                ->after("slug");

            $table->foreign("user_id") // states that "user_id" is the foreign key
                ->references("id") // states thate FK refers to id column
                ->on("users"); // in users table

            $table->foreignId("category_id")
                ->after("user_id")
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // deletes foreign link first
            $table->dropForeign("posts_user_id_foreign");
            // now deletes column
            $table->dropColumn("user_id");

            $table->dropForeign("posts_category_id_foreign");
            $table->dropColumn("category_id");
        });
    }
}
