<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStartAndEndYearInEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('education', function (Blueprint $table) {
            // Change both 'start_year' and 'end_year' to DATE type
            $table->date('start_year')->change();
            $table->date('end_year')->change();  // or 'datetime' if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education', function (Blueprint $table) {
            // Revert both 'start_year' and 'end_year' to their original type
            $table->year('start_year')->change();
            $table->year('end_year')->change();  // or the original type if different
        });
    }
}

