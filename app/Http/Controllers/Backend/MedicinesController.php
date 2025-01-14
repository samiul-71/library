<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\MedicineRequest;
use App\Models\Admin\GenericName;
use App\Models\Admin\Indication;
use App\Models\Admin\Medicine;
use App\Models\Admin\MedicineType;
use App\Models\Admin\PharmaceuticalCompany;
use App\Http\Controllers\Controller;
use App\Models\Admin\TherapeuticClass;

class MedicinesController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'medicine';
        $this->module_title = 'Medicine';
        $this->module_path  = 'medicines';
        $this->module_icon  = 'fa fa-medkit';
        $this->module_model = 'App\Models\Admin\Medicine';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "list";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicines'] = Medicine::paginate(15);

        return view("backend.admin.medicines.medicines.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "create";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine_types']     = MedicineType::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();
        $data['generic_names']      = GenericName::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();
        $data['indications']        = Indication::where('status', true)->orderBy('id')->pluck('key_word', 'id')->toArray();
        $data['pharmaceuticals']    = PharmaceuticalCompany::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();

        $medicine_classes = [
            'ABCDEFGH001' => 'ABCDEFGH001',
            'ABCDEFGH002' => 'ABCDEFGH002',
            'ABCDEFGH003' => 'ABCDEFGH003',
            'ABCDEFGH004' => 'ABCDEFGH004',
            'ABCDEFGH005' => 'ABCDEFGH005',
            'ABCDEFGH006' => 'ABCDEFGH006',
            'ABCDEFGH007' => 'ABCDEFGH007',
            'ABCDEFGH008' => 'ABCDEFGH008',
            'ABCDEFGH009' => 'ABCDEFGH009',
            'ABCDEFGH010' => 'ABCDEFGH010',
            'ABCDEFGH011' => 'ABCDEFGH011',
            'ABCDEFGH012' => 'ABCDEFGH012',
            'ABCDEFGH013' => 'ABCDEFGH013',
            'ABCDEFGH014' => 'ABCDEFGH014',
            'ABCDEFGH015' => 'ABCDEFGH015',
            'ABCDEFGH016' => 'ABCDEFGH016',
            'ABCDEFGH017' => 'ABCDEFGH017',
            'ABCDEFGH018' => 'ABCDEFGH018',
            'ABCDEFGH019' => 'ABCDEFGH019',
            'ABCDEFGH020' => 'ABCDEFGH020',

        ];

        $data['medicine_classes'] = $medicine_classes;


        return view("backend.admin.medicines.medicines.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicineRequest $request)
    {
        $medicineNameExist = $this->checkMedicineName($request->input('name'), $request->input('strength'), $request->input('medicine_type_id'));
//        $medicineCodeExist = $this->checkMedicineCode($request->input('code'));

        if($medicineNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Name with provided Medicine Type and Strength already exists. Please Insert a Different Medicine Name with different Medicine Type and Strength.')->withInput($request->all);
        }
//        if($medicineCodeExist) {
//            return redirect()->back()->with('flash_danger', 'Your Given Code of Medicine Already Exists. Please Insert a Different Code for Medicine.')->withInput($request->all);
//        }

        $medicineData = $request->except('_token', 'medicine_class_id', 'indications_ids');

        $medicineTypeID     = $request->input('medicine_type_id');
        $medicineTypeName   = MedicineType::where('id', $medicineTypeID)->value('name');

        $genericNameID      = $request->input('generic_name_id');
        $genericName        = GenericName::where('id', $genericNameID)->value('name');

        $therapeuticClassIds = GenericName::where('id', $genericNameID)->value('therapeutic_class_ids');
        $therapeuticClassNames = [];

        if ($therapeuticClassIds !== null) {
            $therapeuticClassIdArray = explode(',', $therapeuticClassIds);
            foreach ($therapeuticClassIdArray as $key => $therapeuticClassId){
                $therapeuticClassName = TherapeuticClass::where('id', $therapeuticClassId)->value('name');
                array_push($therapeuticClassNames, $therapeuticClassName);
            }
            $medicineData['therapeutic_class_ids']     = $therapeuticClassIds;
            $medicineData['therapeutic_class_names']   = implode(',', $therapeuticClassNames);
        } else {
            $medicineData['therapeutic_class_ids']     = null;
            $medicineData['therapeutic_class_names']   = null;
        }

        $indicationIDs      = $request->input('indications_ids');
        $indicationKeyWords = [];

        if (count($indicationIDs)){
            foreach ($indicationIDs as $key => $indicationID) {
                $keyWord = Indication::where('id', $indicationID)->value('key_word');
                array_push($indicationKeyWords, $keyWord);
            }
            $medicineData['indications_ids']        = implode(',', $indicationIDs);
            $medicineData['indications_keywords']   = implode(',', $indicationKeyWords);
        } else {
            $medicineData['indications_ids']        = null;
            $medicineData['indications_keywords']   = null;
        }

        $pharmaceuticalsID  = $request->input('pharma_id');
        $pharmaName         = PharmaceuticalCompany::where('id', $pharmaceuticalsID)->value('name');

        $medicineData['medicine_type_name']     = $medicineTypeName;
        $medicineData['generic_name']           = $genericName;
        $medicineData['pharma_name']            = $pharmaName;

        $medicineCode   =   $this->generateMedicineCode($medicineData['name']);
        $medicineData['code']   =   strtoupper($medicineCode);

        $medicine = Medicine::create($medicineData);
        $message = 'Your Medicine has been Created/Added Successfully';

        return redirect()->route("admin.medicine.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "details";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine']  = Medicine::findOrFail($id);

        $data['medicine']['indications_keywords'] = explode(',', $data['medicine']['indications_keywords']);
        $data['medicine']['therapeutic_class_names'] = explode(',', $data['medicine']['therapeutic_class_names']);

        return view("backend.admin.medicines.medicines.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "edit/update";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine']  = Medicine::findOrFail($id);
        $data['medicine_types']     = MedicineType::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();
        $data['generic_names']      = GenericName::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();
        $data['indications']        = Indication::where('status', true)->orderBy('id')->pluck('key_word', 'id')->toArray();
        $data['pharmaceuticals']    = PharmaceuticalCompany::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();

        $medicine_classes = [
            'ABCDEFGH001' => 'ABCDEFGH001',
            'ABCDEFGH002' => 'ABCDEFGH002',
            'ABCDEFGH003' => 'ABCDEFGH003',
            'ABCDEFGH004' => 'ABCDEFGH004',
            'ABCDEFGH005' => 'ABCDEFGH005',
            'ABCDEFGH006' => 'ABCDEFGH006',
            'ABCDEFGH007' => 'ABCDEFGH007',
            'ABCDEFGH008' => 'ABCDEFGH008',
            'ABCDEFGH009' => 'ABCDEFGH009',
            'ABCDEFGH010' => 'ABCDEFGH010',
            'ABCDEFGH011' => 'ABCDEFGH011',
            'ABCDEFGH012' => 'ABCDEFGH012',
            'ABCDEFGH013' => 'ABCDEFGH013',
            'ABCDEFGH014' => 'ABCDEFGH014',
            'ABCDEFGH015' => 'ABCDEFGH015',
            'ABCDEFGH016' => 'ABCDEFGH016',
            'ABCDEFGH017' => 'ABCDEFGH017',
            'ABCDEFGH018' => 'ABCDEFGH018',
            'ABCDEFGH019' => 'ABCDEFGH019',
            'ABCDEFGH020' => 'ABCDEFGH020',

        ];
        $data['medicine_classes'] = $medicine_classes;

        $data['medicine']['indications_ids'] = explode(',', $data['medicine']['indications_ids']);

        return view("backend.admin.medicines.medicines.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineRequest $request, $id)
    {
        $medicineNameExist = $this->checkMedicineForUpdate($request->input('name'), $request->input('strength'), $request->input('medicine_type_id'), $id);

        if($medicineNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Name with provided Medicine Type and Strength already exists. Please Insert a Different Medicine Name with different Medicine Type and Strength.')->withInput($request->all);
        }

        $medicineData       = $request->except('_token', '_method', 'medicine_class_id', 'indications_ids');

        $medicineTypeID     = $request->input('medicine_type_id');
        $medicineTypeName   = MedicineType::where('id', $medicineTypeID)->value('name');

        $genericNameID      = $request->input('generic_name_id');
        $genericName        = GenericName::where('id', $genericNameID)->value('name');

        $therapeuticClassIds = GenericName::where('id', $genericNameID)->value('therapeutic_class_ids');
        $therapeuticClassNames = [];

        if ($therapeuticClassIds !== null) {
            $therapeuticClassIdArray = explode(',', $therapeuticClassIds);
            foreach ($therapeuticClassIdArray as $key => $therapeuticClassId){
                $therapeuticClassName = TherapeuticClass::where('id', $therapeuticClassId)->value('name');
                array_push($therapeuticClassNames, $therapeuticClassName);
            }
            $medicineData['therapeutic_class_ids']     = $therapeuticClassIds;
            $medicineData['therapeutic_class_names']   = implode(',', $therapeuticClassNames);
        } else {
            $medicineData['therapeutic_class_ids']     = null;
            $medicineData['therapeutic_class_names']   = null;
        }

        $pharmaceuticalsID  = $request->input('pharma_id');
        $pharmaName         = PharmaceuticalCompany::where('id', $pharmaceuticalsID)->value('name');

        $indicationIDs      = $request->input('indications_ids');
        $indicationKeyWords = [];

        if (count($indicationIDs)){
            foreach ($indicationIDs as $key => $indicationID) {
                $keyWord = Indication::where('id', $indicationID)->value('key_word');
                array_push($indicationKeyWords, $keyWord);
            }
            $medicineData['indications_ids']        = implode(',', $indicationIDs);
            $medicineData['indications_keywords']   = implode(',', $indicationKeyWords);
        } else {
            $medicineData['indications_ids']        = null;
            $medicineData['indications_keywords']   = null;
        }

        $medicineData['medicine_type_name']     = $medicineTypeName;
        $medicineData['generic_name']           = $genericName;
        $medicineData['pharma_name']            = $pharmaName;

        $medicineUpdateData = $this->manageInputs($medicineData);

        $medicine = Medicine::findOrFail($id);
        $medicine->fill($medicineUpdateData)->save();

        $message = 'Your Selected Medicine has been Updated Successfully';

        return redirect()->route("admin.medicine.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Medicine::find($id);
        $record->destroy($id);

        return;
    }

    /**
     * Display a listing of the trash resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "Trash list";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicines'] = Medicine::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.medicines.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = Medicine::withTrashed()->find($id);
        $record->restore();

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permanentlyDelete($id)
    {
        $record = Medicine::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    public function checkMedicineName($medicineName, $medicineStrength, $medicineTypeID){

        $result = Medicine::withTrashed()->where('name', $medicineName)->where('strength', $medicineStrength)->where('medicine_type_id', $medicineTypeID)->first();
        return $result;
    }

    public function checkMedicineForUpdate($medicineName, $medicineStrength, $medicineTypeID, $id){

        $result = Medicine::withTrashed()->where('name', $medicineName)->where('strength', $medicineStrength)->where('medicine_type_id', $medicineTypeID)->where('id', '!=', $id)->first();
        return $result;
    }

    /**
     * Generate Unique Medicine Code
     *
     * @param $medicineName
     * @return string
     */
    private function generateMedicineCode($medicineName){
        $code = '';
        $name = str_replace(array('[',']',',','&','(',')','-','_',';','.','\\','/'), '', $medicineName);
        foreach(explode(' ',$name)as $name){
            $code .= isset($name[0])?$name[0]:'';
        }
        $code = $code.'-'.rand(1000000,9999999);

        if($this->checkMedicineCode($code) == null){
            return $code;
        } else {
            $this->generateMedicineCode($medicineName);
        }
    }

    /**
     * Queries database to see if the generated Medicine Code exists within database
     *
     * @param $medicineCode
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function checkMedicineCode($medicineCode){
        $result = Medicine::where('code', $medicineCode)->first();
        return $result;
    }

    private function manageInputs($medicineData) {
        $data = [];

        if(isset($medicineData['name']) && $medicineData['name'] != '') {
            $data['name'] = $medicineData['name'];
        }
        if(isset($medicineData['strength']) && $medicineData['strength'] != '') {
            $data['strength'] = $medicineData['strength'];
        }
        if(isset($medicineData['medicine_type_id']) && $medicineData['medicine_type_id'] != '') {
            $data['medicine_type_id'] = $medicineData['medicine_type_id'];
        }
        if(isset($medicineData['generic_name_id']) && $medicineData['generic_name_id'] != '') {
            $data['generic_name_id'] = $medicineData['generic_name_id'];
        }
        if(isset($medicineData['pharma_id']) && $medicineData['pharma_id'] != '') {
            $data['pharma_id'] = $medicineData['pharma_id'];
        }
        if(isset($medicineData['pack_size']) && $medicineData['pack_size'] != '') {
            $data['pack_size'] = $medicineData['pack_size'];
        }
        if(isset($medicineData['no_per_unit']) && $medicineData['no_per_unit'] != '') {
            $data['no_per_unit'] = $medicineData['no_per_unit'];
        }
        if(isset($medicineData['unit_price']) && $medicineData['unit_price'] != '') {
            $data['unit_price'] = $medicineData['unit_price'];
        }
        if(isset($medicineData['currency']) && $medicineData['currency'] != '') {
            $data['currency'] = $medicineData['currency'];
        }
        if(isset($medicineData['description']) && $medicineData['description'] != '') {
            $data['description'] = $medicineData['description'];
        }
        if(isset($medicineData['side_effects']) && $medicineData['side_effects'] != '') {
            $data['side_effects'] = $medicineData['side_effects'];
        }
        if(isset($medicineData['precautions']) && $medicineData['precautions'] != '') {
            $data['precautions'] = $medicineData['precautions'];
        }
        if(isset($medicineData['pregnancy_category']) && $medicineData['pregnancy_category'] != '') {
            $data['pregnancy_category'] = $medicineData['pregnancy_category'];
        }
        if(isset($medicineData['indications_details']) && $medicineData['indications_details'] != '') {
            $data['indications_details'] = $medicineData['indications_details'];
        }
        if(isset($medicineData['adult_dose']) && $medicineData['adult_dose'] != '') {
            $data['adult_dose'] = $medicineData['adult_dose'];
        }
        if(isset($medicineData['child_dose']) && $medicineData['child_dose'] != '') {
            $data['child_dose'] = $medicineData['child_dose'];
        }
        if(isset($medicineData['renal_dose']) && $medicineData['renal_dose'] != '') {
            $data['renal_dose'] = $medicineData['renal_dose'];
        }
        if(isset($medicineData['mode_of_actions']) && $medicineData['mode_of_actions'] != '') {
            $data['mode_of_actions'] = $medicineData['mode_of_actions'];
        }
        if(isset($medicineData['administration']) && $medicineData['administration'] != '') {
            $data['administration'] = $medicineData['administration'];
        }
        if(isset($medicineData['ingredients']) && $medicineData['ingredients'] != '') {
            $data['ingredients'] = $medicineData['ingredients'];
        }
        if(isset($medicineData['contraindications']) && $medicineData['contraindications'] != '') {
            $data['contraindications'] = $medicineData['contraindications'];
        }
        if(isset($medicineData['interactions']) && $medicineData['interactions'] != '') {
            $data['interactions'] = $medicineData['interactions'];
        }
        if(isset($medicineData['therapeutic_class_ids']) && $medicineData['therapeutic_class_ids'] != '') {
            $data['therapeutic_class_ids'] = $medicineData['therapeutic_class_ids'];
        }
        if(isset($medicineData['therapeutic_class_names']) && $medicineData['therapeutic_class_names'] != '') {
            $data['therapeutic_class_names'] = $medicineData['therapeutic_class_names'];
        }
        if(isset($medicineData['indications_ids']) && $medicineData['indications_ids'] != '') {
            $data['indications_ids'] = $medicineData['indications_ids'];
        }
        if(isset($medicineData['indications_keywords']) && $medicineData['indications_keywords'] != '') {
            $data['indications_keywords'] = $medicineData['indications_keywords'];
        }
        if(isset($medicineData['medicine_type_name']) && $medicineData['medicine_type_name'] != '') {
            $data['medicine_type_name'] = $medicineData['medicine_type_name'];
        }
        if(isset($medicineData['generic_name']) && $medicineData['generic_name'] != '') {
            $data['generic_name'] = $medicineData['generic_name'];
        }
        if(isset($medicineData['pharma_name']) && $medicineData['pharma_name'] != '') {
            $data['pharma_name'] = $medicineData['pharma_name'];
        }

        return $data;
    }
}
