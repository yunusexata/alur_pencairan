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
        Schema::create('alur_notification_histories', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_alur_notification_histories', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('alur_notification_histories');
        Schema::dropIfExists('_history_alur_notification_histories');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('remarks_id', 'send_whatsapps_remarks_id_idx');
            $table->index('remarks_type', 'send_whatsapps_remarks_type_idx');
        }

        $table->bigInteger('remarks_id')->unsigned();
        $table->string('remarks_type');
        $table->text('title')->nullable();
        $table->text('note')->nullable();
        $table->string('status')->nullable();

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
