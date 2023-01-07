<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditGamesIdCategoriesIdColumnsFromGamesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games_categories', function (Blueprint $table) {
            $table->renameColumn('games_id', 'game_id');
            $table->renameColumn('categories_id', 'category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games_categories', function (Blueprint $table) {
            //
        });
    }
}
