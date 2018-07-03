<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\LabTestCategory;

class LabTestCategoryController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'lab-test-category';
        $this->module_title = 'Lab Test Category Info';
        $this->module_path  = 'labtestcategory';
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

        $data['labtestCategory']    = LabTestCategory::all();
//        dd($data['labtestCategory']);

        return view("backend.admin.medicines.lab-test-category.index", $data);
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

        return view("backend.admin.medicines.lab-test-category.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $labTestCategoryTitleExist = $this->checkLabTestCategoryTitle($request->input('name'));

        if($labTestCategoryTitleExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Lab Test Category Title already exists. Please provide separate Lab Test Category Cause Title.')->withInput($request->all);
        }

        $labTestCategoryData    = $request->except('_token');

        $labTestCategoryCode          = $this->generateLabTestCode();
        $labTestCategoryData['code'] = strtoupper($labTestCategoryCode);

        $labTestCategoryInfoCreate  = LabTestCategory::create($labTestCategoryData);
        $message              = 'Your Lab Test Category Information has been created successfully!';

        return redirect()->route("admin.lab-test-category.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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

        $data['labTestCategory']    = LabTestCategory::findOrFail($id);

        return view("backend.admin.medicines.lab-test-category.show", $data);
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

        $data['lab_tests_category']    = LabTestCategory::findOrFail($id);

        return view("backend.admin.medicines.lab-test-category.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $labtestName = $this->checkLabTestCategoryTitleForUpdate($request->input('name'), $id);

        if($labtestName) {
            return redirect()->back()->with('flash_danger', 'Your provided Lab Test Category Cause Title already exists. Please provide a separate Lab Test Category.')->withInput($request->all);
        }

        $labTestInfo        = LabTestCategory::findOrFail($id);
        $labTestInfoData  = $request->except('_token');
        $labTestInfo->fill($labTestInfoData)->save();

        $message = "Your selected Lab Test Category record's Information has been updated successfully!";

        return redirect()->route("admin.lab-test-category.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = LabTestCategory::find($id);
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

        $data['labTestCategory']    = LabTestCategory::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.lab-test-category.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = LabTestCategory::withTrashed()->find($id);
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
        $record = LabTestCategory::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }


    public function checkLabTestCategoryTitle($labTestCategoryTitle){

        $result = LabTestCategory::where('name', $labTestCategoryTitle)->first();
        return $result;
    }

    public function checkLabTestCategoryTitleForUpdate($labTestCategoryTitle, $id){

        $result = LabTestCategory::where('name', $labTestCategoryTitle)->where('id', '!=', $id)->first();
        return $result;
    }

    

    private function generateLabTestCode(){
        $code = 'Test-Cat'.'-'.rand(1000,9999);

        if($this->checkLabTestCode($code) == null){
            return $code;
        } else {
            $this->generateLabTestCode();
        }
    }

    private function checkLabTestCode($code){
        $result = LabTestCategory::where('code', $code)->first();
        return $result;
    }
}
