<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\AllergiesRequest;
use App\Http\Requests\Backend\Import\CsvImportRequest;
use App\Models\Admin\Allergy;
use App\Http\Controllers\Controller;
use App\Services\Import\Traits\LabTestImportTrait;
use Illuminate\Support\Facades\DB;

class ImportDataController extends Controller
{
    use LabTestImportTrait;
    public function __construct()
    {
        $this->module_name  = 'allergies';
        $this->module_title = 'Allergies Info';
        $this->module_path  = 'allergies';
        $this->module_icon  = 'fa fa-snowflake-o';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // show csv import page

    public function index() {

        return view('backend.admin.lab_test.import_lab_test');
    }


    // store lab test data

    public function importLabTestData(CsvImportRequest $request)
    {
        try{
            if($request->hasFile('csv_file')) {
                $importedLabTest = $request->file('csv_file');

                $dateAndTime = date("Y_m_d_H_i_s");

                $fileName = $dateAndTime . '_' . $importedLabTest->getClientOriginalName();

                $storage = 'uploads/lab_test/csv';

                if(!is_dir($storage)){
                    mkdir($storage, 0777, true);
                }

                $importedLabTest->move($storage, $fileName);

                // Import the moved file to DB and return response if there were rows affected

                DB::transaction(function () use($storage, $fileName) {


                    $this->import_csv($storage, $fileName);
                });
                $msg = 'successfully imported lab test data';
            }
        } catch(\Exception $e) {
            $msg = $e->getMessage();
        } finally {
        return $msg;
    }

    }



}
