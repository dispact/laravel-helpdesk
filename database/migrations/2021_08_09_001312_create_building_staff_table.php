<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_staff', function (Blueprint $table) {
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->primary(['building_id', 'staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_staff');
    }
}
