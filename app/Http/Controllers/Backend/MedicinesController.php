<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\MedicineRequest;
use App\Models\Admin\GenericName;
use App\Models\Admin\Indication;
use App\Models\Admin\Medicine;
use App\Models\Admin\MedicineType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
//        dd('List of the Medicine Name');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "list";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicines'] = Medicine::all();

        return view("backend.admin.medicines.medicines.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd('Call Create of the Generic Name');
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
//        $data['pharmaceuticals']    = Pharmaceutical::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();

//        dd($data['generic_names']);
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
//        dd($request->all());
        $medicineNameExist = $this->checkMedicineName($request->input('name'));
        $medicineCodeExist = $this->checkMedicineCode($request->input('code'));

        if($medicineNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Already Exists. Please Insert a Different Medicine Name.')->withInput($request->all);
        }
        if($medicineCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Code of Medicine Already Exists. Please Insert a Different Code for Medicine.')->withInput($request->all);
        }

        $medicineData = $request->except('_token');
        $medicine = GenericName::create($medicineData);
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
//        dd('Details of the Medicine');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "details";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine']  = Medicine::findOrFail($id);

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
//        dd('Call Edit Page of the Medicine');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "edit/update";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine']  = Medicine::findOrFail($id);

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
        $medicineNameExist = $this->checkMedicineForUpdate($request->input('name'), $id);
        $medicineCodeExist = $this->checkMedicineCodeForUpdate($request->input('code'), $id);

        if($medicineNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Name Already Exists. Please Insert a Different Medicine Name.')->withInput($request->all);
        }
        if($medicineCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Code of Medicine Already Exists. Please Insert a Different Code for Medicine.')->withInput($request->all);
        }

        $medicine = Medicine::findOrFail($id);
        $medicineData = $request->except('_token');
        $medicine->fill($medicineData)->save();

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
//        dd('Call Destroy Method of the Medicine');
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

    public function checkMedicineName($medicineName){

        $result = Medicine::where('name', $medicineName)->first();
        return $result;
    }

    public function checkMedicineCode($medicineCode){

        $result = Medicine::where('code', $medicineCode)->first();
        return $result;
    }

    public function checkMedicineForUpdate($medicineName, $id){

        $result = Medicine::where('name', $medicineName)->where('id', '!=', $id)->first();
        return $result;
    }

    public function checkMedicineCodeForUpdate($medicineCode, $id){

        $result = Medicine::where('code', $medicineCode)->where('id', '!=', $id)->first();
        return $result;
    }

}
