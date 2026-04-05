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
        Schema::create('alur_pencairans', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_alur_pencairans', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alur_pencairans');
        Schema::dropIfExists('_history_alur_pencairans');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {

            $table->index('plan_transfer', 'alur_pencairans_plan_transfer_idx');
            $table->index('judul', 'alur_pencairans_judul_idx');
            $table->index('status', 'alur_pencairans_status_idx');
        }

        $table->date('plan_transfer')->nullable();
        $table->string('judul');
        $table->integer('qty_cair');
        $table->string('type')->nullable(); // SPEED 20, NORMAL, PROSES 80
        $table->string('status')->nullable(); // PENDING, DONE

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
