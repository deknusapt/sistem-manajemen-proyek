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
        Schema::create('documentations', function (Blueprint $table) {
            $table->id('id_doc');
            $table->string('doc_name');
            $table->text('description')->nullable();
            $table->string('file_photos')->nullable();
            $table->enum('status', ['NeedReview', 'Revision', 'Accepted'])->default('NeedReview');
            $table->date('date_submitted')->nullable();
            $table->foreignId('id_project')->constrained('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentations');
    }
};
