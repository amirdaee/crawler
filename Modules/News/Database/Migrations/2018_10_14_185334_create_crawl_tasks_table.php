<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawl_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('task_url');
            $table->boolean('complete')->default(0);
            $table->timestamps();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->integer('crawl_task_id')->unsigned()->after('complete')->nullable();
            $table->foreign('crawl_task_id')
                ->references('id')
                ->on('crawl_task')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crawl_tasks');

        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign('news_crawl_task_id_foreign');
            $table->dropColumn('crawl_task_id');

        });
    }
}
