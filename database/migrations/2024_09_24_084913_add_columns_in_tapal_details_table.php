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
        Schema::table('tapal_details', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending')->after('unique_id');
            $table->string('approval_remark')->after('status')->nullable();
            $table->datetime('approval_at')->after('approval_remark')->nullable();
            $table->integer('approval_by')->after('approval_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tapal_details', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('approval_remark');
            $table->dropColumn('approval_at');
            $table->dropColumn('approval_by');
        });
    }
};
