<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\V1\LabTestTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Models\Admin\LabTest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LabTestApiController extends ApiController
{
    protected $labTest;
    protected $labTestTransformer;

    /**
     * LabTestApiController constructor.
     * @param LabTest $labTest
     * @param LabTestTransformer $labTestTransformer
     */
    public function __construct(LabTest $labTest, LabTestTransformer $labTestTransformer)
    {
        $this->labTest = $labTest;
        $this->labTestTransformer = $labTestTransformer;
    }

    public function index(Request $request)
    {

        try {

            $data = [
                'labTestList' => []
            ];

            $labTestList = $this->labTest;

            // if any custom query needed, we can implement the query here

            $labTestQuery = $labTestList->orderBy('test_name', 'asc');

            $collection = $this->getCollection($request, $labTestQuery);

            $labTestList = $collection->data;

            if (isset($collection->paginator)) {
                $data['paginator'] = $collection->paginator;
            }

            foreach ($labTestList as $labTest) {
                $data['labTestList'][] = $this->labTestTransformer->transform($labTest);
            }

            $data['_metadata'] = $this->labTestTransformer->metadata($data['labTestList']);

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
                'labTest' => []
            ];

            $labTest = $this->labTest->findOrFail($id);

            $data['labTest'] = $this->labTestTransformer->transform($labTest);

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
