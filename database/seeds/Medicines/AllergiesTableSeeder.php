<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

class AllergiesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncate(config('access.allergies_table'));

        $allergiesData = [
            [
                'allergy_code'          => 'TYPE01',
                'allergy_cause_title'   => 'Balsam of Peru',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE02',
                'allergy_cause_title'   => 'Egg',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE03',
                'allergy_cause_title'   => 'Fish or shellfish',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE04',
                'allergy_cause_title'   => 'Fruit',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE05',
                'allergy_cause_title'   => 'Gluten',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE06',
                'allergy_cause_title'   => 'Garlic',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE07',
                'allergy_cause_title'   => 'Hot peppers',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE08',
                'allergy_cause_title'   => 'Oats',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE09',
                'allergy_cause_title'   => 'Meat',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE10',
                'allergy_cause_title'   => 'Milk',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE11',
                'allergy_cause_title'   => 'Peanut',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE12',
                'allergy_cause_title'   => 'Rice',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE13',
                'allergy_cause_title'   => 'Sesame',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE14',
                'allergy_cause_title'   => 'Soy',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE15',
                'allergy_cause_title'   => 'Sulfites',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE16',
                'allergy_cause_title'   => 'Tartrazine',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE17',
                'allergy_cause_title'   => 'Tree nut',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ],
            [
                'allergy_code'          => 'TYPE18',
                'allergy_cause_title'   => 'Wheat',
                'description'           => 'Anything',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now()
            ]

        ];

        DB::table(config('access.allergies_table'))->insert($allergiesData);

        $this->enableForeignKeys();
    }
}
