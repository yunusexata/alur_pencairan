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
        Schema::create('alur_pencairan_statuses', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_alur_pencairan_statuses', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alur_pencairan_statuses');
        Schema::dropIfExists('_history_alur_pencairan_statuses');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('alur_pencairan_id', 'alur_pencairan_statuses_alur_pencairan_id_idx');
            $table->index('alur_proses_id', 'alur_pencairan_statuses_alur_proses_id_idx');
            $table->index('alur_proses_detail_id', 'alur_pencairan_statuses_alur_proses_detail_id_idx');
            $table->index('status', 'vehicles_status_idx');
            $table->index('nomor_urut', 'vehicles_nomor_urut_idx');
            $table->index('alur_proses_key', 'vehicles_alur_proses_key_idx');
            $table->index('status_updated_by', 'vehicles_status_updated_by_idx');
            $table->index('status_updated_name', 'vehicles_status_updated_name_idx');
        }

        $table->bigInteger('alur_pencairan_id')->unsigned();
        $table->string('status')->nullable();
        $table->text('keterangan')->nullable();

        $table->bigInteger('alur_proses_id')->unsigned();
        $table->bigInteger('alur_proses_detail_id')->unsigned();
        $table->integer('nomor_urut');
        $table->text('name');
        $table->bigInteger('role_id')->unsigned()->nullable();
        $table->string('role_name')->nullable();
        $table->boolean('is_multi')->default(false)->nullable();
        $table->boolean('by_user')->default(false)->nullable();
        $table->bigInteger('user_id')->unsigned()->nullable();
        $table->string('alur_proses_key')->nullable();
        $table->json('role_can_show')->nullable();
        $table->bigInteger("status_updated_by")->unsigned()->nullable();
        $table->dateTime("status_updated_at")->nullable();
        $table->string("status_updated_name")->nullable();

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
