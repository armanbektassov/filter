<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('name');
            $table->text('text');
            $table->date('deadline');

            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('assigned_to')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('set null');

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
        Schema::dropIfExists('tasks');
    }
}
