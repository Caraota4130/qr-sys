<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['url', 'text', 'email', 'contact']);
            $table->text('content');
            $table->string('color')->default('#000000');
            $table->string('background_color')->default('#FFFFFF');
            $table->integer('size')->default(200);
            $table->integer('scan_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qr_codes');
    }
};