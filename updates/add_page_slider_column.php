<?php namespace LZaplata\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class add_page_slider_column extends Migration
{
    public function up()
    {
        Schema::table('lzaplata_pages_pages', function ($table) {
            $table->integer('slider_id')->nullable()->unsigned();
        });
    }
}
