<?php

use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple(['sessions']);

        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);

        $this->call(MedicineTypesTableSeeder::class);
        $this->call(MedicineIndicationTableSeeder::class);
        $this->call(MedicineGenericNameTableSeeder::class);
        $this->call(LabTestCategoriesTableSeeder::class);
        $this->call(AllergiesTableSeeder::class);

        Model::reguard();
    }
}
