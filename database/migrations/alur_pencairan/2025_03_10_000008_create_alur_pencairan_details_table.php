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
        Schema::create('alur_pencairan_details', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_alur_pencairan_details', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alur_pencairan_details');
        Schema::dropIfExists('_history_alur_pencairan_details');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {

            $table->index('alur_pencairan_id', 'alur_pencairan_details_alur_pencairan_id_idx');
            $table->index('rekening_lama', 'alur_pencairan_details_rekening_lama_idx');
            $table->index('rekening_terbaru', 'alur_pencairan_details_rekening_terbaru_idx');
            $table->index('tanggal_transfer', 'alur_pencairan_details_tanggal_transfer_idx');
        }

        $table->bigInteger('alur_pencairan_id');
        $table->string('no_input_jepang')->nullable();
        $table->string('rekening_lama')->nullable();
        $table->string('jenis_rekening_lama')->nullable();
        $table->string('nama_lengkap')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->double('nominal_cair', 20, 2)->nullable();
        $table->string('status')->nullable();
        $table->string('rekening_terbaru')->nullable();
        $table->string('jenis_rekening_terbaru')->nullable();
        $table->bigInteger("rekening_terbaru_updated_by")->unsigned()->nullable();
        $table->dateTime("rekening_terbaru_updated_at")->nullable();
        $table->date('tanggal_transfer')->nullable();
        $table->bigInteger("tanggal_transfer_updated_by")->unsigned()->nullable();
        $table->dateTime("tanggal_transfer_updated_at")->nullable();

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
