<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->string('name');
            $table->string('mobile', 30)->unique();
            $table->string('email', 100)->nullable()->unique();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['m', 'f'])->nullable();
            $table->enum('origin', ['waitlist', 'reservation', 'review', 'vip', 'loyalty'])->nullable();
            $table->boolean('is_vip')->default(0);
            $table->boolean('send_notifications')->default(1);
            $table->timestamp('last_message_sent_at')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
