<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgentIdToCrawlTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crawl_tasks', function (Blueprint $table) {
            $table->integer('agent_id')->unsigned()->after('complete');
            $table->foreign('agent_id')->references('id')->on('agents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crawl_tasks', function (Blueprint $table) {
            $table->dropForeign('crawl_tasks_agent_id_foreign');
            $table->dropColumn('agent_id');

        });
    }
}
