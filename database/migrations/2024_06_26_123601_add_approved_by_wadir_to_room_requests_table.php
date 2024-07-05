<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedByWadirToRoomRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->boolean('approved_by_wadir')->default(false)->after('approved_by_admin');
        });
    }

    public function down()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->dropColumn('approved_by_wadir');
        });
    }
}
