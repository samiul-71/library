<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\V1\DiseaseTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Models\Admin\Disease;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiseasesApiController extends ApiController
{
    protected $disease;
    protected $diseaseTransformer;

    /**
     * DiseasesApiController constructor.
     * @param Disease $disease
     * @param DiseaseTransformer $diseaseTransformer
     */
    public function __construct(Disease $disease, DiseaseTransformer $diseaseTransformer) {
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
                $diseaseQuery->where('code_name', 'LIKE', "%$diseaseCodeOrName%")->Orwhere('code_description', 'LIKE', "%$diseaseCodeOrName%");
                $diseases = $diseaseQuery->limit(20)->get();
            } else {
                $diseases = $diseaseQuery->get()->random(20);
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
