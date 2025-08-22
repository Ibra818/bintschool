<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{User,
};

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table -> string('nom');
            $table -> integer('duree');
            $table -> date('date_debut');
            $table -> string('categorie');
            $table -> string('niveau_difficulte');
            $table -> string('nom_formateur');
            $table->timestamps();
        });

        Schema::table('formations', function (Blueprint $table){
            $table -> foreignIdFor(User::Class) -> constrained() -> cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
        Schema::dropForeignIdFor(User::class);
    }
};
