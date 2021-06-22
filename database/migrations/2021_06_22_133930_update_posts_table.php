<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            // Creo la colonna dello Foreign key
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // Creo la relazione della foreign key
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
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
            // Faccio il down delle foreign key
            $table->dropForeign('posts_category_id_foreign');

            // Faccio il down della colonna
            $table->dropColumn('category_id');

        });
    }
}
