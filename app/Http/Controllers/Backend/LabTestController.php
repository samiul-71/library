<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin\LabTest;
use App\Http\Requests\Admin\LabTestRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\LabTestCategory;

class LabTestController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'lab-test';
        $this->module_title = 'Lab Test';
        $this->module_path  = 'lab-test';
        $this->module_icon  = 'fa fa-heartbeat';
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

        $data['lab_tests'] = LabTest::all();

        return view("backend.admin.medicines.lab-test.index", $data);
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

        $data['lab_test_categories']    = LabTestCategory::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();

        return view("backend.admin.medicines.lab-test.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabTestRequest $request)
    {
        $labTestNameExist = $this->checkLabTestNameExist($request->input('test_name'));

        if($labTestNameExist) {
            return redirect()->back()->with('flash_danger', 'Your given Lab test name already exists. Please Insert a Different Lab Test Name.')->withInput($request->all);
        }

        $labTestData                        = $request->except('_token');

        $labTestCategoryID                  = $request->input('test_category_id');
        $labTestCategoryName                = LabTestCategory::where('id', $labTestCategoryID)->value('name');
        $labTestData['test_category_name']  = $labTestCategoryName;

        $labTestCode           =   $this->generateLabTestCode($labTestData['test_name']);
        $labTestData['code']   =   strtoupper($labTestCode);

        $labTestCreate = LabTest::create($labTestData);

        $message = 'Your Lab test record has been created/added successfully!';

        return redirect()->route("admin.lab-test.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
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

        $data['lab_test']  = LabTest::findOrFail($id);

        return view("backend.admin.medicines.lab-test.show", $data);
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

        $data['lab_tests']  = LabTest::findOrFail($id);

        $data['lab_test_categories']    = LabTestCategory::where('status', true)->orderBy('id')->pluck('name', 'id')->toArray();

        return view("backend.admin.medicines.lab-test.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LabTestRequest $request, $id)
    {
        $labTestNameExist = $this->checkLabTestNameForUpdate($request->input('name'), $id);

        if($labTestNameExist) {
            return redirect()->back()->with('flash_danger', 'Your Given Lab Test Name Already Exists. Please Insert a Different Lab Test Name.')->withInput($request->all);
        }

        $labTestData       = $request->except('_token');

        $labTestCategoryID                  = $request->input('test_category_id');
        $labTestCategoryName                = LabTestCategory::where('id', $labTestCategoryID)->value('name');
        $labTestData['test_category_name']  = $labTestCategoryName;

        $labTest = LabTest::findOrFail($id);
        $labTest->fill($labTestData)->save();

        $message = 'Your Selected Lab Test Record has been Updated Successfully';

        return redirect()->route("admin.lab-test.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = LabTest::find($id);
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

        $data['lab_tests'] = LabTest::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.lab-test.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = LabTest::withTrashed()->find($id);
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
        $record = LabTest::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    public function checkLabTestNameExist($labTestName){

        $result = LabTest::where('test_name', $labTestName)->first();
        return $result;
    }

    public function checkLabTestNameForUpdate($labTestName, $id){

        $result = LabTest::where('test_name', $labTestName)->where('id', '!=', $id)->first();
        return $result;
    }

    /**
     * Generate Unique Lab Test Code
     *
     * @param $labTestName
     * @return string
     */
    private function generateLabTestCode($labTestName){
        $code = '';
        $name = str_replace(array('[',']',',','&','(',')','-','_',';','.','\\','/'), '', $labTestName);
        foreach(explode(' ',$name)as $name){
            $code .= isset($name[0])?$name[0]:'';
        }
        $code = $code.'-'.rand(10000,99999);

        if($this->checkLabTestCode($code) == null){
            return $code;
        } else {
            $this->generateLabTestCode($labTestName);
        }
    }

    /**
     * Queries database to see if the generated Lab Test Code exists within database
     *
     * @param $labTestCode
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function checkLabTestCode($labTestCode){
        $result = LabTest::where('code', $labTestCode)->first();
        return $result;
    }
}
