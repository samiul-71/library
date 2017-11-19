<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class LabTestTransformer extends Transformer
{
    /**
     * @property string imageUploadedPath
     */
//    protected $imageUploadedPath;
    protected $labTestCategoryTransformer;

    /**
     * LabTestCategoryTransformer constructor.
     */
    public function __construct(LabTestCategoryTransformer $labTestCategoryTransformer)
    {
//        $this->imageUploadedPath  = $this->getImageRootPath() . topicImagePath();
        $this->labTestCategoryTransformer = $labTestCategoryTransformer;
    }

    public function transform($labTest) {

        return [
            'id'                       => $labTest->id,
            'code'                     => $labTest->code,
            'testName'                 => $labTest->test_name,
            'methodology'              => $labTest->methodology,
            'description'              => $this->formatHtml($labTest->description),
            'additionalInformation'    => $this->formatHtml($labTest->additional_information),
            'labTestCategory'          => $this->getLabTestCategory($labTest->labTestCategory),
            'costInfo'                 => $this->getCost($labTest->cost, $labTest->currency)
            //            'sortOrder'        => $pharmaceutical->sort_order
        ];
    }

    public function metadata($collection = null)
    {
        if($collection != null) {
            return [
                'totalResult'  => count($collection),
            ];
        }
        return [];
    }

    public function getCost($cost, $currency) {

        $costArray = [
            'cost'      =>  $cost,
            'currency'  =>  $currency
        ];

        return $costArray;
    }

    public function getLabTestCategory($category) {
        if($category == null) {
            $labTestCategory = null;
        } else {
            $labTestCategory = $this->labTestCategoryTransformer->transform($category);
        }

        return $labTestCategory;
    }
}
