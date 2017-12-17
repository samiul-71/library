<?php

namespace App\Http\Controllers\Backend;

use App\Models\Access\User\User;
use App\Models\Admin\PharmaceuticalCompany;
use App\Http\Requests\Admin\PharmaceuticalCompaniesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PharmaceuticalCompaniesController extends Controller
{
    public function __construct()
    {
        $this->module_name  = 'pharmaceutical-companies';
        $this->module_title = 'Pharmaceutical Companies';
        $this->module_path  = 'pharmaceutical-companies';
        $this->module_icon  = 'fa fa-industry';
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

        $data['pharmaceutical_companies'] = PharmaceuticalCompany::all();

        return view("backend.admin.medicines.pharmaceutical-companies.index", $data);
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

        return view("backend.admin.medicines.pharmaceutical-companies.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmaceuticalCompaniesRequest $request)
    {
        $pharmaNameExist            = $this->checkPharmaName($request->input('name'));
        $pharmaEmailAtUsersExist    = $this->checkPharmaEmailAtUsers($request->input('email'));
        $pharmaEmailAtPharmaExist   = $this->checkPharmaEmailAtPharma($request->input('email'));

        if($pharmaNameExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Pharmaceutical Company name already exists. Please provide a different name.')->withInput($request->all);
        }
        if($pharmaEmailAtUsersExist) {
            return redirect()->back()->with('flash_danger', 'A user with your provided email address already exits. Please provide a different email address.')->withInput($request->all);
        }
        if($pharmaEmailAtPharmaExist) {
            return redirect()->back()->with('flash_danger', 'A Pharmaceutical Company with your provided email address already exists. Please provide a different email address.')->withInput($request->all);
        }

        $pharmaDataForUsers['first_name']        = $request->input('name');
        $pharmaDataForUsers['last_name']         = '';
        $pharmaDataForUsers['mobile']            = $request->input('phone');
        $pharmaDataForUsers['email']             = $request->input('email');
        $pharmaDataForUsers['password']          = bcrypt($request->input('password'));
        $pharmaDataForUsers['confirmation_code'] = md5(uniqid(mt_rand(), true));
        $pharmaDataForUsers['confirmed']         = true;
        $userCreate                              = User::create($pharmaDataForUsers);

        $pharmaDataForPharma                     = $request->except('_token', 'password');
        $pharmaDataForPharma['user_id']          = $userCreate->id;
        $pharmaCreate                            = PharmaceuticalCompany::create($pharmaDataForPharma);

        $message                                 = 'Your Pharmaceutical Company record has been created successfully!';

        return redirect()->route("admin.pharmaceutical-companies.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * - If one needs to show details page from trashed page, then follow the process below:
     *
     * - The Show method must accept Request
     *
     *   $pharmaComp = PharmaceuticalCompany::select('*');

     *   if($request->has('with') && $request->input('with') == 'trashed') {

     *       $pharmaComp = $pharmaComp->withTrashed();
     *   }
     *   $data['pharmaceutical_companies']    = $pharmaComp->findOrFail($id);
     *
     * - Append "?with=trashed" along with the url declared at trash page
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

        $data['pharmaceutical_companies']  = PharmaceuticalCompany::findOrFail($id);

        return view("backend.admin.medicines.pharmaceutical-companies.show", $data);
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

        $data['pharmaceutical_companies']    = PharmaceuticalCompany::findOrFail($id);

        return view("backend.admin.medicines.pharmaceutical-companies.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PharmaceuticalCompaniesRequest $request, $id)
    {
        $pharmaNameExist    = $this->checkPharmaNameForUpdate($request->input('name'), $id);
        $pharmaEmailExist   = $this->checkPharmaEmailForUpdate($request->input('email'), $id);

        if($pharmaNameExist) {
            return redirect()->back()->with('flash_danger', 'Your provided Pharmaceutical Company name already exists. Please provide a different name.')->withInput($request->all);
        }
        if($pharmaEmailExist) {
            return redirect()->back()->with('flash_danger', 'A Pharmaceutical Company with your provided email address already exists. Please provide a different email address.')->withInput($request->all);
        }

        $pharmaRecord                            = PharmaceuticalCompany::findOrFail($id);
        $pharmaDataForPharma                     = $request->except('_token', 'password');
        $pharmaRecord->fill($pharmaDataForPharma)->save();

        $message = 'Your selected Pharmaceutical Company record has been updated successfully!';

        return redirect()->route("admin.pharmaceutical-companies.index")->with('flash_success', '<i class="fa fa-check"></i> ' . $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = PharmaceuticalCompany::find($id);
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

        $data['pharmaceutical_companies']    = PharmaceuticalCompany::onlyTrashed()->orderBy('id', 'asc')->get();

        return view("backend.admin.medicines.pharmaceutical-companies.trash", $data);
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $record = PharmaceuticalCompany::withTrashed()->find($id);
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
        $record = PharmaceuticalCompany::withTrashed()->find($id);
        $record->forceDelete($id);

        return;
    }

    public function checkPharmaName($pharmaName){

        $result = PharmaceuticalCompany::withTrashed()->where('name', $pharmaName)->first();
        return $result;
    }

    public function checkPharmaEmailAtUsers($email){

        $result = User::where('email', $email)->first();
        return $result;
    }

    public function checkPharmaEmailAtPharma($email){

        $result = PharmaceuticalCompany::where('email', $email)->first();
        return $result;
    }

    public function checkPharmaNameForUpdate($pharmaName, $id){

        $result = PharmaceuticalCompany::withTrashed()->where('name', $pharmaName)->where('id', '!=', $id)->first();
        return $result;
    }

    public function checkPharmaEmailForUpdate($email, $id){

        $result = PharmaceuticalCompany::where('email', $email)->where('id', '!=', $id)->first();
        return $result;
    }
}
