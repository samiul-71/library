<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\AllergiesRequest;
use App\Models\Admin\Allergy;
use App\Http\Controllers\Controller;

class AllergiesController extends Controller
{
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
    public function index()
    {
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_action']  = "list";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['allergies']    = Allergy::all();

        return view("backend.admin.allergies.allergies.index", $data);
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
        $data['module_action']  = "create";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        return view("backend.admin.allergies.allergies.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AllergiesRequest $request)
    {
        $allergyCauseTitleExist = $this->checkAllergyCauseTitle($request->input('allergy_cause_title'));
        $allergyCodeExist       = $this->checkAllergyCode($request->input('allergy_code'));

        if($allergyCauseTitleExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Allergy Cause Title already exists. Please provide separate Allergy Cause Title.')->withInput($request->all);
        }
        if($allergyCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Allergy code already exits. Please provide a different Allergy code.')->withInput($request->all);
        }

        $allergiesInfoData    = $request->except('_token');
        $allergiesInfoCreate  = Allergy::create($allergiesInfoData);
        $message              = 'Your Allergy Information has been created successfully!';

        return redirect()->route("admin.allergies.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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
        $data['module_action']  = "details";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['allergies']    = Allergy::findOrFail($id);

        return view("backend.admin.allergies.allergies.show", $data);
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
        $data['module_action']  = "edit/update";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['allergies']    = Allergy::findOrFail($id);

        return view("backend.admin.allergies.allergies.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AllergiesRequest $request, $id)
    {
        $allergyCauseTitle = $this->checkAllergyCauseTitleForUpdate($request->input('allergy_cause_title'), $id);
        $allergyCodeExist  = $this->checkAllergyCodeForUpdate($request->input('allergy_code'), $id);

        if($allergyCauseTitle) {
            return redirect()->back()->with('flash_danger', 'Your provided Allergy Cause Title already exists. Please provide a separate Allergy Cause Title.')->withInput($request->all);
        }
        if($allergyCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Allergy code already exits. Please provide a different Allergy code.')->withInput($request->all);
        }

        $allergyInfo        = Allergy::findOrFail($id);
        $allergiesInfoData  = $request->except('_token');
        $allergyInfo->fill($allergiesInfoData)->save();

        $message = "Your selected Allergy record's Information has been updated successfully!";

        return redirect()->route("admin.allergies.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Allergy::find($id);
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
        $data['module_action']  = "Trash list";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['allergies']    = Allergy::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.allergies.allergies.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = Allergy::withTrashed()->find($id);
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
        $record = Allergy::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    public function checkAllergyCauseTitle($allergyCauseTitle){

        $result = Allergy::where('allergy_cause_title', $allergyCauseTitle)->first();
        return $result;
    }

    public function checkAllergyCode($allergyCode){

        $result = Allergy::where('allergy_code', $allergyCode)->first();
        return $result;
    }

    public function checkAllergyCauseTitleForUpdate($allergyCauseTitle, $id){

        $result = Allergy::where('allergy_cause_title', $allergyCauseTitle)->where('id', '!=', $id)->first();
        return $result;
    }

    public function checkAllergyCodeForUpdate($allergyCauseTitle, $id){

        $result = Allergy::where('allergy_code', $allergyCauseTitle)->where('id', '!=', $id)->first();
        return $result;
    }
}
