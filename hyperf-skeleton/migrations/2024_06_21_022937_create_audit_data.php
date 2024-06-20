<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateAuditData extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audit_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key',256)->nullable();
            $table->longText('value')->nullable();
            $table->unsignedBigInteger('audit_action_id');
            $table->foreign('audit_action_id')->references('id')->on('audit_action');
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_data');
    }
}
