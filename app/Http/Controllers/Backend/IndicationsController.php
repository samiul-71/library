<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin\Indication;
use App\Http\Requests\Admin\IndicationsRequest;
use App\Http\Controllers\Controller;

class IndicationsController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'indications';
        $this->module_title = 'Indications';
        $this->module_path  = 'indications';
        $this->module_icon  = 'fa fa-hospital-o';
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

        $data['indications'] = Indication::all();

        return view("backend.admin.medicines.indications.index", $data);
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

        return view("backend.admin.medicines.indications.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndicationsRequest $request)
    {
        $indicationKeyWordExist = $this->checkIndicationKeyWord($request->input('key_word'));
        $indicationCodeExist = $this->checkIndicationCode($request->input('code'));

        if($indicationKeyWordExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Key word(s) already exists. Please provide separate key word(s).')->withInput($request->all);
        }
        if($indicationCodeExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Indication code already exits. Please provide a different Indication code.')->withInput($request->all);
        }

        $indicationsData = $request->except('_token');
        $indicationsCreate = Indication::create($indicationsData);
        $message = 'Your Indication record has been created successfully!';

        return redirect()->route("admin.indications.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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

        $data['indications']  = Indication::findOrFail($id);

        return view("backend.admin.medicines.indications.show", $data);
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

        $data['indications']  = Indication::findOrFail($id);

        return view("backend.admin.medicines.indications.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IndicationsRequest $request, $id)
    {
        $indicationKeyWordExist = $this->checkIndicationKeyWordForUpdate($request->input('key_word'), $id);
        $indicationCodeExist = $this->checkIndicationCodeForUpdate($request->input('code'), $id);

        if($indicationKeyWordExist) {
            return redirect()->back()->with('flash_danger', 'The Indication record for the provided key words does not exist. Please choose a valid Indication record.')->withInput($request->all);
        }
        if($indicationCodeExist) {
            return redirect()->back()->with('flash_danger', 'The Indication record for the provided code does not exist. Please choose a valid Indication record.')->withInput($request->all);
        }

        $indicationRecord = Indication::findOrFail($id);
        $indicationsData = $request->except('_token');
        $indicationRecord->fill($indicationsData)->save();

        $message = 'Your selected Indication record has been updated successfully!';

        return redirect()->route("admin.indications.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Indication::find($id);
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

        $data['indications'] = Indication::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.indications.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = Indication::withTrashed()->find($id);
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
        $record = Indication::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    public function checkIndicationKeyWord($indicationKeyWord){

        $result = Indication::where('key_word', $indicationKeyWord)->first();
        return $result;
    }

    public function checkIndicationCode($indicationCode){

        $result = Indication::where('code', $indicationCode)->first();
        return $result;
    }

    public function checkIndicationKeyWordForUpdate($indicationKeyWord, $id){

        $result = Indication::where('key_word', $indicationKeyWord)->where('id', '!=', $id)->first();
        return $result;
    }

    public function checkIndicationCodeForUpdate($indicationCode, $id){

        $result = Indication::where('code', $indicationCode)->where('id', '!=', $id)->first();
        return $result;
    }
}
