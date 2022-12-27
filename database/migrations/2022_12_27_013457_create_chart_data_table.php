<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // php artisan migrate --path=/database/migrations/full_migration_file_name_migration.php


        Schema::create('ChartData', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('user_id');
            $table->foreignIdFor(User::class);


            $table->date('chart_date');
            $table->integer('chart_amount');

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
        Schema::dropIfExists('chart_data');
    }
};
