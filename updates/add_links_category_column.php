<?php namespace LZaplata\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddLinksCategoryColumn extends Migration
{
    public function up()
    {
        Schema::table('lzaplata_pages_blocks', function ($table) {
            $table->integer('links_category_id')->nullable()->unsigned();
        });

        Schema::table('lzaplata_pages_contents', function ($table) {
            $table->integer('links_category_id')->nullable()->unsigned();
        });
    }

    public function down()
    {

    }
}