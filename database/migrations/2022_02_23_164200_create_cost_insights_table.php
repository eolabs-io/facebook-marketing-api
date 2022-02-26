<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\FacebookMarketingApi\Domain\Shared\Migrations\FacebookMarketingApiMigration;

return new class extends FacebookMarketingApiMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook_cost_insights', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id');
            $table->bigInteger('ad_id');
            $table->bigInteger('campaign_id');
            $table->bigInteger('adset_id');
            $table->date('date_start');
            $table->date('date_stop');
            $table->string('impressions');
            $table->float('spend');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facebook_cost_insights');
    }
};
