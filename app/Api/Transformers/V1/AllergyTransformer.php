<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class AllergyTransformer extends Transformer
{
    /**
     * @property string imageUploadedPath
     */
    protected $imageUploadedPath;

    /**
     * AllergyTransformer constructor.
     */
    public function __construct()
    {
//        $this->imageUploadedPath  = $this->getImageRootPath() . topicImagePath();
    }

    public function transform($allergy) {

        return [
            'id'                => $allergy->id,
            'code'              => $allergy->allergy_code,
            'title'             => trim($allergy->allergy_cause_title),
            'description'       => $this->formatHtml($allergy->description),
//            'imagePath'        => ($allergy->image_path != null) ? $this->imageUploadedPath . $allergy->image_path : null,
            'sortOrder'        => $allergy->sort_order
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
