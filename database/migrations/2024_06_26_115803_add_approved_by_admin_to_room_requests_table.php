<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedByAdminToRoomRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->boolean('approved_by_admin')->default(false)->after('status');
        });
    }

    public function down()
    {
        Schema::table('room_requests', function (Blueprint $table) {
            $table->dropColumn('approved_by_admin');
        });
    }
}
