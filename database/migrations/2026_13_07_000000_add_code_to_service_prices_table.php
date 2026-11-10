<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeToServicePricesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('service_prices', function (Blueprint $table) {
            if (!Schema::hasColumn('service_prices', 'code')) {
                $table->string('code')->nullable()->after('service_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_prices', function (Blueprint $table) {
            if (Schema::hasColumn('service_prices', 'code')) {
                $table->dropColumn('code');
            }
        });
    }
}

return new AddCodeToServicePricesTable();
