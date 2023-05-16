<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert(array(
            0 =>
            array(
                'id' => '1',
                'name' => 'Norte',
                'slug' => 'norte'
            ),
            1 =>
            array(
                'id' => '2',
                'name' => 'Nordeste',
                'slug' => 'nordeste'
            ),
            2 =>
            array(
                'id' => '3',
                'name' => 'Centro-Oeste',
                'slug' => 'centro-oeste'
            ),
            3 =>
            array(
                'id' => '4',
                'name' => 'Sudeste',
                'slug' => 'sudeste'
            ),
            4 =>
            array(
                'id' => '5',
                'name' => 'Sul',
                'slug' => 'sul'
            ),
        ));
    }
}
