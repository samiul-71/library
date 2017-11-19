<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class MedicineTransformer extends Transformer
{
    /**
     * @property string imageUploadedPath
     */
    protected $imageUploadedPath;

    /**
     * MedicineTransformer constructor.
     */
    public function __construct()
    {
//        $this->imageUploadedPath  = $this->getImageRootPath() . topicImagePath();
    }

    public function transform($medicine) {

        return [
            'id'                => $medicine->id,
            'code'              => $medicine->code,
            'name'              => $medicine->name,
            'description'       => $this->formatHtml($medicine->description),
            'strength'          => trim($medicine->strength),
            'indications'       => trim($medicine->indications_details),
//            'image_path'        => ($medicine->image_path != null) ? $this->imageUploadedPath . $medicine->image_path : null,
            'sortOrder'        => $medicine->sort_order
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
