<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('number');
            $table->boolean('win');
            $table->unsignedSmallInteger('sum');
            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete()
            ;
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
