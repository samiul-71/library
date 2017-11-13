<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\TherapeuticClassRequest;
use App\Models\Admin\TherapeuticClass;
use App\Models\Admin\TherapeuticClassGroup;
use App\Http\Controllers\Controller;

class TherapeuticClassController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'therapeutic-class';
        $this->module_title = 'Therapeutic Class';
        $this->module_path  = 'therapeutic-class';
        $this->module_icon  = 'fa fa-object-ungroup';
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

        $data['therapeutic_classes'] = TherapeuticClass::all();

        return view("backend.admin.medicines.therapeutic-class.index", $data);
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

        $data['therapeutic_class_group_parents']    =   TherapeuticClassGroup::where('parent_id', '0')->orderBy('id')->pluck('name', 'id')->toArray();

        return view("backend.admin.medicines.therapeutic-class.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TherapeuticClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TherapeuticClassRequest $request)
    {
        if($request->input('parent_id') == 'no_parent')
        {
            return redirect()->back()->with('flash_danger', 'You must select a Therapeutic Class Group. None was selected!')->withInput($request->all);
        }

        $therapeuticClassNameExist = $this->checkTherapeuticClass($request->input('name'));

        if($therapeuticClassNameExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Therapeutic Class Name already exists. Please provide separate Therapeutic Class Name.')->withInput($request->all);
        }

        $therapeuticClassData                               = $request->except('_token', 'parent_id');
        $therapeuticClassData['therapeutic_class_group_id'] = $request->input('parent_id');
        $therapeuticClassCreate                             = TherapeuticClass::create($therapeuticClassData);
        $message                                            = 'Your Therapeutic Class Information has been created successfully!';

        return redirect()->route("admin.therapeutic-class.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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

        $data['therapeutic_class']              = TherapeuticClass::findOrFail($id);
        $data['therapeutic_class_group']        = TherapeuticClassGroup::where('id', $data['therapeutic_class']->therapeutic_class_group_id)->where('status', true)->value('name');

        return view("backend.admin.medicines.therapeutic-class.show", $data);
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

        $data['therapeutic_classes']      = TherapeuticClass::findOrFail($id);
        $data['therapeutic_class_group']  = TherapeuticClassGroup::where('id', $data['therapeutic_classes']->therapeutic_class_group_id)->where('status', true)->value('name');
        $data['therapeutic_class_group']  = $data['therapeutic_class_group'] == null ? 'None' : $data['therapeutic_class_group'];

        $data['therapeutic_class_group_parents'] = TherapeuticClassGroup::where('parent_id', '0')->orderBy('id')->pluck('name', 'id')->toArray();

        return view("backend.admin.medicines.therapeutic-class.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TherapeuticClassRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TherapeuticClassRequest $request, $id)
    {
        if($request->input('parent_id') == 'no_parent')
        {
            return redirect()->back()->with('flash_danger', 'You must select a Therapeutic Class Group. None was selected!')->withInput($request->all);
        }

        $therapeuticClassNameExist = $this->checkTherapeuticClassForUpdate($request->input('name'), $id);

        if($therapeuticClassNameExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Therapeutic Class Name already exists. Please provide a separate Therapeutic Class Name.')->withInput($request->all);
        }

        $therapeuticClassInfo = TherapeuticClass::findOrFail($id);
        $therapeuticClassGroupData = $request->except('_token', 'parent_id');

        $therapeuticClassGroupData['therapeutic_class_group_id'] = $request->input('parent_id');

        $therapeuticClassInfo->fill($therapeuticClassGroupData)->save();

        $message = "Your selected Therapeutic Class's Information has been updated successfully!";

        return redirect()->route("admin.therapeutic-class.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = TherapeuticClass::find($id);
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

        $data['therapeutic_classes']    = TherapeuticClass::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.therapeutic-class.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = TherapeuticClass::withTrashed()->find($id);
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
        $record = TherapeuticClass::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    /**
     * Get Children using Therapeutic Class Group ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getChildren($id)
    {
        $children = TherapeuticClassGroup::where('parent_id', $id)->orderBy('id')->pluck('name', 'id')->toArray();

        return response()->json($children);
    }

    public function checkTherapeuticClass($name){

        $result = TherapeuticClass::where('name', $name)->first();
        return $result;
    }

    public function checkTherapeuticClassForUpdate($name, $id){

        $result = TherapeuticClass::where('name', $name)->where('id', '!=', $id)->first();
        return $result;
    }
}
