<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class AllergyTransformer extends Transformer
{
    /**
     * @property string image_uploaded_path
     */
    protected $image_uploaded_path;

    /**
     * TopicTransformer constructor.
     */
    public function __construct()
    {
//        $this->image_uploaded_path  = $this->getImageRootPath() . topicImagePath();
    }

    public function transform($allergy) {

        return [
            'id'                => $allergy->id,
            'code'              => $allergy->allergy_code,
            'title'             => trim($allergy->allergy_cause_title),
            'description'       => $this->formatHtml($allergy->description),
//            'image_path'        => ($allergy->image_path != null) ? $this->image_uploaded_path . $allergy->image_path : null,
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
