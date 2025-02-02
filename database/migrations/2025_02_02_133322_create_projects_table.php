<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('id_project');
            $table->string('project_name');
            $table->bigInteger('cost');
            $table->enum('complexity', ['low', 'medium', 'high']);
            $table->enum('status', ['notstarted', 'pending', 'onprogress', 'canceled', 'completed'])->default('notstarted');
            $table->text('description')->nullable();
            $table->string('file_workorder')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->foreignId('id_client')->constrained('clients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
