<?php

namespace App\Services\Import\Traits;


use App\Models\Admin\LabTest;
use App\Models\Admin\LabTestCategory;
use Carbon\Carbon;

trait LabTestImportTrait
{

    protected $categoryCode;
    protected function import_csv($path, $filename)
    {
        $csv = $path.'/' . $filename;

        session(['is_key_checked'=>false]);

        \Excel::filter('chunk')->load($csv)->chunk(250, function($results) {
            if(!session('is_key_checked')) {
                $labTestData = $results[0]->toArray();
                $isValidInput = $this->keyExists($labTestData);
                session(['is_valid_input'=>$isValidInput]);
                session(['is_key_checked'=>true]);
            }

            if(!session('is_valid_input')){
                throw new \Exception('Required Field In CSV file not found');
            }
            foreach($results as $row) {

                if(is_null($row->category_code) || is_null($row->test_name)) {
                    continue;
                }

                if(is_null($this->categoryCode) || (!is_null($this->categoryCode) && $this->categoryCode != $row->category_code)) {
                    $this->categoryCode = $row->category_code;
                    $labTest = LabTestCategory::where('code',$row->category_code)->first();
                }


                if(!$labTest) {
                    continue;
                }

                /* TODO need to modify this code if medicine is available */



                    $testInformation = [
                        'test_name' => $row->test_name,
                        'test_category_id' => $labTest->id,
                        'test_category_name' => $labTest->name,
                        'methodology'    =>  $row->methodology,
                        'code'    =>  $this->generateLabTestCode(),
                        'description'    =>  $row->description,
                        'additional_information'    =>  $row->additional_information,
                        'cost'    =>  $row->cost,
                        'currency'    =>  $row->currency,

                    ];

                    LabTest::create($testInformation);


                // Create lab test
            }


        });
        return unlink($csv);
    }

    public function keyExists($importedArray)
    {

        if(!array_key_exists('category_code', $importedArray ) || !array_key_exists('test_name',$importedArray)
            || !array_key_exists('methodology',$importedArray) || !array_key_exists('description',$importedArray)
            || !array_key_exists('additional_information',$importedArray) || !array_key_exists('cost',$importedArray)
            || !array_key_exists('currency',$importedArray)) {
            return false;
        }
        return true;
    }

    protected function generateLabTestCode() {
        $externalCode = 'Lab-Test-'.random_int(1000,10000);

        $validator = \Validator::make(['code'=>$externalCode], [
            'code' => 'unique:lab_test',
        ]);

        if($validator->fails()) {
            $externalTrxId = null;
            $this->generateLabTestCode();

        }

        return $externalCode;
    }

}