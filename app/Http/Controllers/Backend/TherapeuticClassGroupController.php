<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin\TherapeuticClassGroup;
use App\Http\Requests\Admin\TherapeuticClassGroupRequest;
use App\Http\Controllers\Controller;

class TherapeuticClassGroupController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'therapeutic-class-group';
        $this->module_title = 'Therapeutic Class Group';
        $this->module_path  = 'therapeutic-class-group';
        $this->module_icon  = 'fa fa-object-group';
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

        $data['therapeutic_class_groups']    = TherapeuticClassGroup::all();

        return view("backend.admin.medicines.therapeutic-class-group.index", $data);
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

        return view("backend.admin.medicines.therapeutic-class-group.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TherapeuticClassGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TherapeuticClassGroupRequest $request)
    {
        $therapeuticClassGroupNameExist = $this->checkTherapeuticClassGroup($request->input('name'));

        if($therapeuticClassGroupNameExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Therapeutic Class Group Name already exists. Please provide separate Therapeutic Class Group Name.')->withInput($request->all);
        }

        $therapeuticClassGroupData              = $request->except('_token', 'parent_id');
        $therapeuticClassGroupData['parent_id'] = $request->input('parent_id') == 'no_parent' ? '0' : $request->input('parent_id');
        $therapeuticClassGroupCreate            = TherapeuticClassGroup::create($therapeuticClassGroupData);
        $message                                = 'Your Therapeutic Class Group Information has been created successfully!';

        return redirect()->route("admin.therapeutic-class-group.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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

        $data['therapeutic_class_group']        = TherapeuticClassGroup::findOrFail($id);
        $data['therapeutic_class_group_parent'] = TherapeuticClassGroup::where('id',$data['therapeutic_class_group']->parent_id )->where('status', true)->value('name');

        return view("backend.admin.medicines.therapeutic-class-group.show", $data);
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

        $data['therapeutic_class_groups']        = TherapeuticClassGroup::findOrFail($id);
        $data['therapeutic_class_group_parent']  = TherapeuticClassGroup::where('id',$data['therapeutic_class_groups']->parent_id )->where('status', true)->value('name');
        $data['therapeutic_class_group_parent']  = $data['therapeutic_class_group_parent'] == null ? 'None' : $data['therapeutic_class_group_parent'];
        $data['therapeutic_class_group_parents'] = TherapeuticClassGroup::where('parent_id', '0')->orderBy('id')->pluck('name', 'id')->toArray();

        return view("backend.admin.medicines.therapeutic-class-group.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TherapeuticClassGroupRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TherapeuticClassGroupRequest $request, $id)
    {
        $therapeuticClassGroupNameExist = $this->checkTherapeuticClassGroupForUpdate($request->input('name'), $id);

        if($therapeuticClassGroupNameExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Therapeutic Class Group Name already exists. Please provide a separate Therapeutic Class Group Name.')->withInput($request->all);
        }

        $therapeuticClassGroupInfo = TherapeuticClassGroup::findOrFail($id);
        $therapeuticClassGroupData = $request->except('_token', 'parent_id');

        if($request->has('parent_id')){
            $therapeuticClassGroupData['parent_id'] = $request->input('parent_id') == 'no_parent' ? '0' : $request->input('parent_id');
        }

        $therapeuticClassGroupInfo->fill($therapeuticClassGroupData)->save();

        $message = "Your selected Therapeutic Class Group's Information has been updated successfully!";

        return redirect()->route("admin.therapeutic-class-group.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = TherapeuticClassGroup::find($id);
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

        $data['therapeutic_class_groups']    = TherapeuticClassGroup::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.therapeutic-class-group.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = TherapeuticClassGroup::withTrashed()->find($id);
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
        $record = TherapeuticClassGroup::withTrashed()->find($id);
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

    public function checkTherapeuticClassGroup($name){

        $result = TherapeuticClassGroup::where('name', $name)->first();
        return $result;
    }

    public function checkTherapeuticClassGroupForUpdate($name, $id){

        $result = TherapeuticClassGroup::where('name', $name)->where('id', '!=', $id)->first();
        return $result;
    }
}
