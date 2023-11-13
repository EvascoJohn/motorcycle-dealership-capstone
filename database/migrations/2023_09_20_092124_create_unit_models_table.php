<?php

use App\Enums;
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
        Schema::create('unit_models', function (Blueprint $table) {
            $table->id();
            $table->string("model_name")->nullable();
            $table->string("image_file")->nullable();
            $table->decimal("price")->nullable();

            $table->enEngineTypesum("body_type", Enums\UnitTypes::values())->nullable();
            $table->string("engine_type")->nullable();
            $table->decimal("displacement")->nullable();
            $table->decimal("engine_oil")->nullable();
            $table->enum("starting_system", Enums\StartingSystemTypes::values())->nullable();
            $table->enum("transmission", Enums\TransmissionTypes::values())->nullable();
            $table->decimal("fuel_tank_capacity")->nullable();
            $table->decimal("net_weight")->nullable();
            $table->string("dimension")->nullable();
            $table->json("colors")->nullable();
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_models');
    }
};
