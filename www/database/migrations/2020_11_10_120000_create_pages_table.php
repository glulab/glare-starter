<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ignite\Support\Migration\MigratePermissions;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->string('slug')->nullable();

            $table->string('title');
            $table->string('description')->nullable();
            $table->text('text')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->boolean('sitemap')->default(false);
            $table->string('sitemap_changefreq')->default('weekly');
            $table->string('sitemap_priority')->default('0.5');

            $table->string('type')->default('page');
            $table->string('route')->nullable();

            $table->json('options')->nullable();

            $table->bigInteger('position')->nullable();

            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('pages');
    }
}
