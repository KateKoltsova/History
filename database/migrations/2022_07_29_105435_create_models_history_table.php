<?php
namespace El\migrations;

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
        Schema::create('models_history', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->text('field_old_value')->nullable();
            $table->text('field_new_value')->nullable();
            $table->integer('user_id')->nullable();
            $table->dateTime('modification_date');
            $table->morphs('historian');
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
        Schema::dropIfExists('models_history');
    }
};
