<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

class MedicineTypesTableSeeder extends Seeder
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

        $this->truncate(config('access.medicine_type_table'));

        $medicineTypes = [
            [
                'name'          => 'Tablet',
                'code'          => 'TA01',
                'description'   => 'Tablet',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Capsule',
                'code'          => 'CA01',
                'description'   => 'Capsule',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Injection',
                'code'          => 'IN01',
                'description'   => 'Injection',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Syrup',
                'code'          => 'SY01',
                'description'   => 'Syrup',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Suspension',
                'code'          => 'SP01',
                'description'   => 'Suspension',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Drops',
                'code'          => 'DP01',
                'description'   => 'Drops',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Suppository',
                'code'          => 'SP11',
                'description'   => 'Suppository',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Gel',
                'code'          => 'GL01',
                'description'   => 'Gel',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Ointment',
                'code'          => 'OM01',
                'description'   => 'Ointment',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Solution',
                'code'          => 'SL01',
                'description'   => 'Solution',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Lotion',
                'code'          => 'LT01',
                'description'   => 'Lotion',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Cream',
                'code'          => 'CM01',
                'description'   => 'Cream',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Ear Drops',
                'code'          => 'ED01',
                'description'   => 'Ear Drops',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Eye Drops',
                'code'          => 'EYD01',
                'description'   => 'Eye Drops',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Eye Gel',
                'code'          => 'EG01',
                'description'   => 'Eye Gel',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Eye Ointment',
                'code'          => 'EO01',
                'description'   => 'Eye Ointment',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Oral Gel',
                'code'          => 'OG01',
                'description'   => 'Oral Gel',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Solid Oral',
                'code'          => 'SO01',
                'description'   => 'Solid Oral',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Liquid Oral',
                'code'          => 'LO01',
                'description'   => 'Liquid Oral',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Drops Oral',
                'code'          => 'OD01',
                'description'   => 'Drops Oral',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Nasal Spray',
                'code'          => 'NS01',
                'description'   => 'Nasal Spray',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Nasal Drops',
                'code'          => 'ND01',
                'description'   => 'Nasal Drops',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Oily Injection',
                'code'          => 'OI01',
                'description'   => 'Oily Injection',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Injection Powder',
                'code'          => 'INP01',
                'description'   => 'Injection Powder',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Topical Solution',
                'code'          => 'TPS01',
                'description'   => 'Topical Solution',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Injectable Solution',
                'code'          => 'INS01',
                'description'   => 'Injectable Solution',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Nebulizing Solution',
                'code'          => 'NBS01',
                'description'   => 'Nebulizing Solution',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Nebulizer Vial',
                'code'          => 'NBV01',
                'description'   => 'Nebulizer Vial',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Inhalar',
                'code'          => 'INHL01',
                'description'   => 'Inhalar',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Inhalation Liquid',
                'code'          => 'INHL02',
                'description'   => 'Inhalation Liquid',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Inhalation Cylinder',
                'code'          => 'INHL03',
                'description'   => 'Inhalation Cylinder',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Inhalation Medicinal Gas',
                'code'          => 'INHLG04',
                'description'   => 'Inhalation Medicinal Gas',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        DB::table(config('access.medicine_type_table'))->insert($medicineTypes);

        $this->enableForeignKeys();
    }
}
