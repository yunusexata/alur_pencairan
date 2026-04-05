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
        Schema::create('alur_pencairan_histories', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_alur_pencairan_histories', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alur_pencairan_histories');
        Schema::dropIfExists('_history_alur_pencairan_histories');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('alur_pencairan_id', 'alur_pencairan_histories_alur_pencairan_id_idx');
            $table->index('alur_proses_id', 'alur_pencairan_histories_alur_proses_id_idx');
            $table->index('alur_proses_detail_id', 'alur_pencairan_histories_alur_proses_detail_id_idx');
        }

        $table->bigInteger('alur_pencairan_id')->unsigned();
        $table->bigInteger('alur_proses_id')->unsigned();
        $table->bigInteger('alur_proses_detail_id')->unsigned();
        $table->bigInteger('user_id')->unsigned();
        $table->string('status')->nullable();
        $table->text('keterangan')->nullable();
        $table->bigInteger("status_updated_by")->nullable();
        $table->dateTime("status_updated_at")->nullable();
        $table->string("status_updated_name")->nullable();

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
