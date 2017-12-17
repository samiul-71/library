<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\MedicineTypeRequest;
use App\Models\Admin\MedicineType;
use App\Http\Controllers\Controller;

class MedicineTypeController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'medicine-type';
        $this->module_title = 'Medicine Type';
        $this->module_path  = 'medicine-type';
        $this->module_icon  = 'fa fa-plus-square';
        $this->module_model = 'App\Models\Admin\MedicineType';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd('List of the Medicine Type');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "list";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine_types'] = MedicineType::all();

        return view("backend.admin.medicines.medicine-types.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd('Call Create of the Medicine Type');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "create";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        return view("backend.admin.medicines.medicine-types.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicineTypeRequest $request)
    {
//        dd($request->all());
        $medicineTypeNameExist = $this->checkMedicineTypeName($request->input('name'));
        $medicineTypeCodeExist = $this->checkMedicineTypeCode($request->input('code'));

        if($medicineTypeNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Type Name Already Exists. Please Insert a Different Medicine Type Name.')->withInput($request->all);
        }
        if($medicineTypeCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Type Code Already Exists. Please Insert a Different Medicine Type Code.')->withInput($request->all);
        }

        $medicineTypeData = $request->except('_token');
        $medicineType = MedicineType::create($medicineTypeData);
        $message = 'Your Medicine Type has been Created/Added Successfully';

        return redirect()->route("admin.medicine-type.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        dd('Details of the Medicine Type');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "details";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine_type']  = MedicineType::findOrFail($id);

        return view("backend.admin.medicines.medicine-types.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        dd('Call Edit Page of the Medicine Type');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "edit/update";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine_type']  = MedicineType::findOrFail($id);

        return view("backend.admin.medicines.medicine-types.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MedicineTypeRequest $request, $id)
    {
        $medicineTypeNameExist = $this->checkMedicineTypeNameForUpdate($request->input('name'), $id);
        $medicineTypeCodeExist = $this->checkMedicineTypeCodeForUpdate($request->input('code'), $id);

        if($medicineTypeNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Type Name Already Exists. Please Insert a Different Medicine Type Name.')->withInput($request->all);
        }
        if($medicineTypeCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Type Code Already Exists. Please Insert a Different Medicine Type Code.')->withInput($request->all);
        }

        $medicineType = MedicineType::findOrFail($id);
        $medicineTypeData = $request->except('_token');
        $medicineType->fill($medicineTypeData)->save();

        $message = 'Your Selected Medicine Type has been Updated Successfully';

        return redirect()->route("admin.medicine-type.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd('Call Destroy Method of the Medicine Type');
        $record = MedicineType::find($id);
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

        $data['medicine_types'] = MedicineType::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.medicine-types.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = MedicineType::withTrashed()->find($id);
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
        $record = MedicineType::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    public function checkMedicineTypeName($medicineTypeName){

        $result = MedicineType::where('name', $medicineTypeName)->first();
        return $result;
    }

    public function checkMedicineTypeCode($medicineTypeCode){

        $result = MedicineType::where('code', $medicineTypeCode)->first();
        return $result;
    }

    public function checkMedicineTypeNameForUpdate($medicineTypeName, $id){

        $result = MedicineType::where('name', $medicineTypeName)->where('id', '!=', $id)->first();
        return $result;
    }

    public function checkMedicineTypeCodeForUpdate($medicineTypeCode, $id){

        $result = MedicineType::where('code', $medicineTypeCode)->where('id', '!=', $id)->first();
        return $result;
    }

}
