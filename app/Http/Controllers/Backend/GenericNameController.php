<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\GenericNameRequest;
use App\Models\Admin\GenericName;
use App\Models\Admin\Indication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenericNameController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'generic-name';
        $this->module_title = 'Generic Name';
        $this->module_path  = 'generic-name';
        $this->module_icon  = 'fa fa-h-square';
        $this->module_model = 'App\Models\Admin\GenericName';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd('List of the Medicine Generic Name');
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "list";

        $data['page_heading']   = ucfirst($data['module_name']);
        $data['title']          = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['medicine_generic_names'] = GenericName::all();

        return view("backend.admin.medicines.generic-names.index", $data);
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

        $data['indications']        = Indication::where('status', true)->orderBy('id')->pluck('key_word', 'id')->toArray();

        return view("backend.admin.medicines.generic-names.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenericNameRequest $request)
    {
        $medicineGenericNameExist = $this->checkMedicineGenericName($request->input('name'));
        $medicineGenericNameCodeExist = $this->checkMedicineGenericNameCode($request->input('code'));

        if($medicineGenericNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Generic Name Already Exists. Please Insert a Different Medicine Generic Name.')->withInput($request->all);
        }
        if($medicineGenericNameCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Code of Medicine Generic Name Already Exists. Please Insert a Different Code for Medicine Generic Name.')->withInput($request->all);
        }

        $medicineGenericNameData = $request->except('_token');

        $indicationIDs      = $request->input('indications_ids');
        $indicationKeyWords = [];

        if (count($indicationIDs)){
            foreach ($indicationIDs as $key => $indicationID) {
                $keyWord = Indication::where('id', $indicationID)->value('key_word');
                array_push($indicationKeyWords, $keyWord);
            }
            $medicineGenericNameData['indications_ids']        = implode(',', $indicationIDs);
            $medicineGenericNameData['indications_keywords']   = implode(',', $indicationKeyWords);
        } else {
            $medicineGenericNameData['indications_ids']        = null;
            $medicineGenericNameData['indications_keywords']   = null;
        }

        $medicineGenericName = GenericName::create($medicineGenericNameData);

        $message = 'Your Medicine Generic Name has been Created/Added Successfully';

        if (count($indicationIDs)) {
            $genericName = GenericName::find($medicineGenericName->id);
            $genericName->indications()->sync($indicationIDs);
        }

        return redirect()->route("admin.generic-name.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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

        $data['generic_name']  = GenericName::findOrFail($id);

        $data['generic_name']['indications_keywords'] = explode(',', $data['generic_name']['indications_keywords']);

        return view("backend.admin.medicines.generic-names.show", $data);
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

        $data['generic_name']   = GenericName::findOrFail($id);

        $data['indications']        = Indication::where('status', true)->orderBy('id')->pluck('key_word', 'id')->toArray();
        $data['generic_name']['indications_ids'] = explode(',', $data['generic_name']['indications_ids']);
        return view("backend.admin.medicines.generic-names.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenericNameRequest $request, $id)
    {
        $medicineGenericNameExist = $this->checkMedicineGenericNameForUpdate($request->input('name'), $id);
        $medicineGenericNameCodeExist = $this->checkMedicineGenericNameCodeForUpdate($request->input('code'), $id);

        if($medicineGenericNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Medicine Generic Name Already Exists. Please Insert a Different Medicine Generic Name.')->withInput($request->all);
        }
        if($medicineGenericNameCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Code of Medicine Generic Name Already Exists. Please Insert a Different Code for Medicine Generic Name.')->withInput($request->all);
        }

        $medicineGenericName = GenericName::findOrFail($id);
        $medicineGenericNameData = $request->except('_token');

        $indicationIDs      = $request->input('indications_ids');
        $indicationKeyWords = [];

        if (count($indicationIDs)){
            foreach ($indicationIDs as $key => $indicationID) {
                $keyWord = Indication::where('id', $indicationID)->value('key_word');
                array_push($indicationKeyWords, $keyWord);
            }
            $medicineGenericNameData['indications_ids']        = implode(',', $indicationIDs);
            $medicineGenericNameData['indications_keywords']   = implode(',', $indicationKeyWords);
        } else {
            $medicineGenericNameData['indications_ids']        = null;
            $medicineGenericNameData['indications_keywords']   = null;
        }

        $medicineGenericName->fill($medicineGenericNameData)->save();

        $message = 'Your Selected Medicine Generic Name has been Updated Successfully';

        if (count($indicationIDs)) {
            $genericName = GenericName::find($medicineGenericName->id);
            $genericName->indications()->sync($indicationIDs);
        }

        return redirect()->route("admin.generic-name.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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
        $record = GenericName::find($id);
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

        $data['medicine_generic_names'] = GenericName::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.generic-names.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = GenericName::withTrashed()->find($id);
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
        $record = GenericName::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    public function checkMedicineGenericName($medicineGenericName){

        $result = GenericName::where('name', $medicineGenericName)->first();
        return $result;
    }

    public function checkMedicineGenericNameCode($medicineGenericNameCode){

        $result = GenericName::where('code', $medicineGenericNameCode)->first();
        return $result;
    }

    public function checkMedicineGenericNameForUpdate($medicineGenericName, $id){

        $result = GenericName::where('name', $medicineGenericName)->where('id', '!=', $id)->first();
        return $result;
    }

    public function checkMedicineGenericNameCodeForUpdate($medicineGenericNameCode, $id){

        $result = GenericName::where('code', $medicineGenericNameCode)->where('id', '!=', $id)->first();
        return $result;
    }

}
