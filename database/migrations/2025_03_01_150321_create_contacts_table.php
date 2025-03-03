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
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique();
            $table->string("first_name");
            $table->string("last_name");
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("email")->unique();
            $table->string("address")->nullable()->default(null);
            $table->string("phone_number")->nullable()->default(null);
            $table->string("birth_date")->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
