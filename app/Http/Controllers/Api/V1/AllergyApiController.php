<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\V1\AllergyTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Models\Admin\Allergy;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AllergyApiController extends ApiController
{
    protected $allergy;
    protected $allergyTransformer;

    /**
     * AllergyApiController constructor.
     * @param Allergy $allergy
     * @param AllergyTransformer $allergyTransformer
     */
    public function __construct(Allergy $allergy, AllergyTransformer $allergyTransformer)
    {
        $this->allergy = $allergy;
        $this->allergyTransformer = $allergyTransformer;
    }

    public function index(Request $request)
    {

        try {

            $data = [
                'allergyList' => []
            ];

            $allergies = $this->allergy;

            // if any custom query needed, we can implement the query here

            $allergiesQuery = $allergies->orderBy('allergy_cause_title', 'asc');

            $collection = $this->getCollection($request, $allergiesQuery);

            $allergies = $collection->data;

            if (isset($collection->paginator)) {
                $data['paginator'] = $collection->paginator;
            }

            foreach ($allergies as $allergy) {
                $data['allergyList'][] = $this->allergyTransformer->transform($allergy);
            }

            $data['_metadata'] = $this->allergyTransformer->metadata($data['allergyList']);

            $data['statusCode'] = $this->getStatusCode();
            $data['status'] = "success";

        } catch (\Exception $e) {

            $this->setStatusCode(400);
            $data['statusCode'] = $this->getStatusCode();
            $data['status'] = "error";
            $data['error'] = [
                'message' => $e->getMessage()
            ];

        } finally {
            return response()->json($data);
        }
    }

    public function show($id)
    {

        try {

            $data = [
                'allergy' => []
            ];

            $allergy = $this->allergy->findOrFail($id);

            $data['allergy'] = $this->allergyTransformer->transform($allergy);

            $data['statusCode'] = $this->getStatusCode();
            $data['status'] = "success";

        } catch (ModelNotFoundException $exception) {
            $this->setStatusCode(204);
            $data['statusCode'] = $this->getStatusCode();
            $data['status'] = "error";
            $data['error'] = [
                'message' => 'Sorry, this record is not found in the database.'
            ];
        } catch (\Exception $e) {

            $this->setStatusCode(400);
            $data['statusCode'] = $this->getStatusCode();
            $data['status'] = "error";
            $data['error'] = [
                'message' => $e->getMessage()
            ];

        } finally {
            return response()->json($data);
        }
    }
}
