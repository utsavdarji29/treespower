<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreereportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treereports', function (Blueprint $table) {
            $table->id();
            $table->string('user_id','50')->default('');
            $table->string('subject','255')->default('');
            $table->string('location','255')->default('');
            $table->string('issue_details','255')->default('');
            $table->date('date','50')->default('');
            $table->string('task_id','50')->default('');
            $table->string('tree_id','50')->default('');
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
        Schema::dropIfExists('treereports');
    }
}
