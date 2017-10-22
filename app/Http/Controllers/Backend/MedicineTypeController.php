<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Admin\MedicineTypeRequest;
use App\Models\Admin\MedicineType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicineTypeController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'medicine-type';
        $this->module_title = 'Medicine Type';
        $this->module_path  = 'medicine-type';
        $this->module_icon  = 'fa fa-plus-square';
        $this->module_model = 'App\Models\MedicineType';
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the trash resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash($organizationID, $employeeID)
    {
        $data['module_name']    = $this->module_name;
        $data['module_title']   = $this->module_title;
        $data['module_path']    = $this->module_path;
        $data['module_icon']    = $this->module_icon;
        $data['module_model']   = $this->module_model;
        $data['module_action']  = "Trash list";

        $data['title'] = ucfirst($data['module_name']) . ' ' . ucfirst($data['module_action']);

        $data['employee']       = EmployeeProfile::where('id', $employeeID)->where('organization_id', $organizationID)->first();
        $data['user']           = $data['employee']->user;
        $data['organization']   = Organization::findOrFail($organizationID);

        $data['attachReports'] = AttachReport::onlyTrashed()->where('user_id', $data['user']->id)->orderBy('id', 'desc')->get();

        return view("backend.admin.attach-report.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($organizationID, $employeeID, $id)
    {
        $module_model = $this->module_model;
        $record = $module_model::withTrashed()->find($id);
        $record->restore();

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permanentlyDelete($organizationID, $employeeID, $id)
    {
        $module_model = $this->module_model;
        $record = $module_model::withTrashed()->find($id);
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
}
