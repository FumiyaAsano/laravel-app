<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Coca-Cola', 'サントリー', 'キリン'] as $name) {
            Company::firstOrCreate(
                ['company_name' => $name],
                ['company_name' => $name]
            );
        }
    }
}
