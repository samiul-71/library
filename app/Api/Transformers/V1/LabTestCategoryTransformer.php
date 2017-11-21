<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class LabTestCategoryTransformer extends Transformer
{
    /**
     * @property string imageUploadedPath
     */
    protected $imageUploadedPath;

    /**
     * LabTestCategoryTransformer constructor.
     */
    public function __construct()
    {
//        $this->imageUploadedPath  = $this->getImageRootPath() . topicImagePath();
    }

    public function transform($labTestCategory) {

        return [
            'id'                        => $labTestCategory->id,
            'name'                      => $labTestCategory->name,
            'code'                      => $labTestCategory->code,
            'description'               => $this->formatHtml($labTestCategory->description)
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
}
