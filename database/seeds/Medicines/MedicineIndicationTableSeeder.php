<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Carbon\Carbon;

class MedicineIndicationTableSeeder extends Seeder
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

        $this->truncate(config('access.medicine_indications_table'));

        $medicineIndications = [
            [
                'key_word'      => 'Productive Cough',
                'code'          => 'IND00001',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Vitamin C Deficiency',
                'code'          => 'IND00002',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Zinc Deficiencies',
                'code'          => 'IND00003',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Nasal Congestion',
                'code'          => 'IND00004',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Osteoporosis',
                'code'          => 'IND00005',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Chronic Disorders',
                'code'          => 'IND00006',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Allergic Conditions',
                'code'          => 'IND00007',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Vitamin D Deficiency',
                'code'          => 'IND00008',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Vitamin E Deficiency',
                'code'          => 'IND00009',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Moderate Pain and/or Fever',
                'code'          => 'IND00010',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Vitamin Deficiencies',
                'code'          => 'IND00011',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Alimentary Anemia',
                'code'          => 'IND00012',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Macrocytic Heyperchromic Anemia',
                'code'          => 'IND00013',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Alimentary Anemia',
                'code'          => 'IND00014',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Vitamin B Complex Deficiency',
                'code'          => 'IND00014',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Iron Deficiency',
                'code'          => 'IND00015',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Nutritional Anemias',
                'code'          => 'IND00016',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Skin Infection',
                'code'          => 'IND00017',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Severe Headaches',
                'code'          => 'IND00018',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Common Cold',
                'code'          => 'IND00019',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Allergic Rhinitis',
                'code'          => 'IND00020',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Influenza',
                'code'          => 'IND00021',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Acute and Chronic Sinusitis',
                'code'          => 'IND00022',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Ascariasis',
                'code'          => 'IND00023',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Enterobiasis',
                'code'          => 'IND00024',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Contaminated Wounds',
                'code'          => 'IND00025',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Mucous Membranes',
                'code'          => 'IND00026',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'key_word'      => 'Mucus Secretions',
                'code'          => 'IND00027',
                'status'        => true,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
//            [
//                'key_word'      => 'XXXXXXXX',
//                'code'          => 'IND00001',
//                'status'        => true,
//                'created_at'    => Carbon::now(),
//                'updated_at'    => Carbon::now(),
//            ],
//            [
//                'key_word'      => 'XXXXXXXX',
//                'code'          => 'IND00001',
//                'status'        => true,
//                'created_at'    => Carbon::now(),
//                'updated_at'    => Carbon::now(),
//            ],
//            [
//                'key_word'      => 'XXXXXXXX',
//                'code'          => 'IND00001',
//                'status'        => true,
//                'created_at'    => Carbon::now(),
//                'updated_at'    => Carbon::now(),
//            ],
//            [
//                'key_word'      => 'XXXXXXXX',
//                'code'          => 'IND00001',
//                'status'        => true,
//                'created_at'    => Carbon::now(),
//                'updated_at'    => Carbon::now(),
//            ],
//            [
//                'key_word'      => 'XXXXXXXX',
//                'code'          => 'IND00001',
//                'status'        => true,
//                'created_at'    => Carbon::now(),
//                'updated_at'    => Carbon::now(),
//            ],
//            [
//                'key_word'      => 'XXXXXXXX',
//                'code'          => 'IND00001',
//                'status'        => true,
//                'created_at'    => Carbon::now(),
//                'updated_at'    => Carbon::now(),
//            ],
        ];

        DB::table(config('access.medicine_indications_table'))->insert($medicineIndications);

        $this->enableForeignKeys();
    }
}
