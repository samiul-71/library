<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

class LabTestCategoriesTableSeeder extends Seeder
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

        $this->truncate(config('access.lab_test_categories_table'));

        $labTestCategories = [
            [
                'name'          => 'Haematology',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Sugar Profile',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Kidney Profile',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Electrolytes-Minerals',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Lipid Profile',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Liver Function Test',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Cardiac Enzymes',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Others Enzymes',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Mycobac-TB Complex',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Tumour Marker',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Serology Immunology',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'name'          => 'Hormone Assays',
                'description'   => 'Anything',
                'code'          => 'TYPE01',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]
        ];

        DB::table(config('access.lab_test_categories_table'))->insert($labTestCategories);

        $this->enableForeignKeys();
    }
}
