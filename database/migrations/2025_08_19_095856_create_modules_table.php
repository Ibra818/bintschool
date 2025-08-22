<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{Formation,};

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('video_intro') -> nullable();
            $table->string('module_video');
            $table->string('duree') -> nullable();
            $table->timestamps();
        });

        // Schema::table('modules', function (Blueprint $table){
        //     $table -> foreignIdFor(Formation::class) -> constrained() -> cascadeOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
        Shcema::dropForeignIdFor(Formation::class);
    }
};
