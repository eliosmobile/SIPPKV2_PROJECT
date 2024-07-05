<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomIdToRoomRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id')->nullable()->after('surat');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });
    }
}
