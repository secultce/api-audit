<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class AuditAuthTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_remote', 50)->nullable(false);
            $table->string('addr_host', 50)->nullable(false);
            $table->string('referer', 150)->nullable(true);
            $table->string('resource_uri', 150)->nullable(false);
            $table->string('userAgent', 150)->nullable(false);
            $table->string('createTime', 150)->nullable(false);
            $table->string('userLogin', 150)->nullable(false);
            $table->string('action', 150)->nullable(false);
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth');
    }
}
