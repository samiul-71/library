<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\V1\ChronicDiseaseTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Models\Admin\ChronicDisease;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ChronicDiseaseApiController extends ApiController
{
    protected $disease;
    protected $diseaseTransformer;

    /**
     * DiseasesApiController constructor.
     * @param ChronicDisease $disease
     * @param ChronicDiseaseTransformer $diseaseTransformer
     */
    public function __construct(ChronicDisease $disease, ChronicDiseaseTransformer $diseaseTransformer) {
        $this->disease = $disease;
        $this->diseaseTransformer = $diseaseTransformer;
    }

    public function index(Request $request) {

        try {
            $data = [];

            $diseaseList = $this->disease;

            $diseaseQuery = $diseaseList->where('status',true);

            if ($request->has('search_param')) {
                $diseaseCodeOrName = trim($request->input('search_param'));
                $diseaseQuery->where('disease_name', 'LIKE', "%$diseaseCodeOrName%")->orWhere('disease_description', 'LIKE', "%$diseaseCodeOrName%")->orderBy('disease_name','ASC');
                $diseases = $diseaseQuery->limit(20)->get();
            } else {
                $diseases = $diseaseQuery->orderBy('disease_name','ASC')->get()->random(20);
            }

            foreach ($diseases as $disease) {
                $data['diseaseList'][] = $this->diseaseTransformer->transform($disease);
            }

            $data['status_code'] = $this->getStatusCode();
            $data['status']      = "success";
            $data['message']     = "Your requested diseases are found and listed here";

        } catch (\Exception $e) {

            $data['status_code'] = 400;
            $data['status']      = "error";
            $data['error']       = ['message' => $e->getMessage()];

        } finally {
            return response()->json($data);
        }
    }

    public function show($id) {

        try {
            $data               = ['disease' => []];
            $disease           = $this->disease->findOrFail($id);
            $data['disease']   = $this->diseaseTransformer->transform($disease);
            $data['status_code'] = $this->getStatusCode();
            $data['status']     = "success";
        } catch (ModelNotFoundException $exception) {
            $this->setStatusCode(204);
            $data['status_code'] = $this->getStatusCode();
            $data['status']     = "error";
            $data['error']      = ['message' => 'Sorry, this record is not found in the database.'];
        } catch (\Exception $e) {
            $this->setStatusCode(400);
            $data['status_code'] = $this->getStatusCode();
            $data['status']     = "error";
            $data['error']      = ['message' => $e->getMessage()];
        } finally {
            return response()->json($data);
        }
    }
}
