<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MuniTypeSeeder extends Seeder
{
    public function run(): void
    {
        // DB::table('municipality_types')->truncate();
        $muniType = "INSERT INTO municipality_types (muni_type_name,created_at,updated_at) VALUES
        ('महानगरपालिका', NULL, NULL),
        ('उपमहानगरपालिका', NULL, NULL),
        ('नगरपालिका', NULL, NULL),
        ('गाउँपालिका', NULL, NULL)";

        DB::insert($muniType);
    }
}
