<?php

namespace App\Http\Controllers\Api\V1;

use App\Api\Transformers\V1\MedicineTransformer;
use App\Http\Controllers\Api\ApiController;
use App\Models\Admin\Medicine;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MedicineApiController extends ApiController
{
    protected $medicine;
    protected $medicineTransformer;

    /**
     * AllergyApiController constructor.
     * @param Medicine $medicine
     * @param MedicineTransformer $medicineTransformer
     */
    public function __construct(Medicine $medicine, MedicineTransformer $medicineTransformer)
    {
        $this->medicine = $medicine;
        $this->medicineTransformer = $medicineTransformer;
    }

    public function index(Request $request)
    {

        try {

            $data = [
                'medicineList' => []
            ];

            $medicineList = $this->medicine;

            // if any custom query needed, we can implement the query here

            $medicineQuery = $medicineList->orderBy('id', 'asc');

            if ($request->has('name')) {
                $medicineName   =   trim($request->input('name'));
                $medicineQuery->where('name', 'LIKE', "%$medicineName%");
            }

            $collection = $this->getQueryData($request, $medicineQuery);

            $medicineList = $collection->data;

            if (isset($collection->paginator)) {
                $data['paginator'] = $collection->paginator;
            }

            foreach ($medicineList as $medicine) {
                $data['medicineList'][] = $this->medicineTransformer->transform($medicine);
            }

            $data['_metadata'] = $this->medicineTransformer->metadata($data['medicineList']);

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
                'medicine' => []
            ];

            $medicine = $this->medicine->findOrFail($id);

            $data['medicine'] = $this->medicineTransformer->transform($medicine);

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

    public function getQueryData(Request $request, $moduleQuery, $queryString = '', $limit = 50)
    {
        $collection = [];

        if($request->has('limit')) {
            if($request->input('limit') <= 100) {
                $limit = (int) $request->input('limit');
            } else {
                $limit = 10;
            }
        }

        $collection['data'] = $moduleQuery->paginate($limit);
        $platform = '&platform=web';

        $queryString = $queryString . $platform . '&limit=' . $limit;

        $collection['paginator'] = $this->paginatorData($collection['data'], $queryString);

        return (object) $collection;
    }
}
