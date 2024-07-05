<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedByDirekturToRoomRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->boolean('approved_by_direktur')->default(false)->after('approved_by_wadir');
        });
    }

    public function down()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->dropColumn('approved_by_direktur');
        });
    }
}
