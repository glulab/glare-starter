<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ignite\Support\Migration\MigratePermissions;

class CreateCategorizedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorized', function (Blueprint $table) {

            $table->bigInteger('category_id');
            $table->bigInteger('categorized_id');
            $table->string('categorized_type');

            $table->unique(['category_id', 'categorized_id', 'categorized_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorized');
    }
}
