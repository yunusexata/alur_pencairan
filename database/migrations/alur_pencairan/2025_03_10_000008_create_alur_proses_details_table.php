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
        Schema::create('alur_proses_details', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_alur_proses_details', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alur_proses_details');
        Schema::dropIfExists('_history_alur_proses_details');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('alur_proses_id', 'alur_proses_details_alur_proses_id_idx');
            $table->index('nomor_urut', 'alur_proses_details_nomor_urut_idx');
            $table->index('alur_proses_key', 'alur_proses_details_alur_proses_key_idx');
        }

        $table->bigInteger('alur_proses_id');
        $table->integer('nomor_urut');
        $table->text('name');
        $table->bigInteger('role_id')->nullable();
        $table->string('role_name')->nullable();
        $table->boolean('is_multi')->default(false)->nullable();
        $table->boolean('by_user')->default(false)->nullable();
        $table->bigInteger('user_id')->nullable();
        $table->string('alur_proses_key')->nullable();
        $table->json('role_can_show')->nullable();

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
