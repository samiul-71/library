<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class PharmaceuticalCompanyTransformer extends Transformer
{
    /**
     * @property string imageUploadedPath
     */
    protected $imageUploadedPath;

    /**
     * PharmaceuticalCompanyTransformer constructor.
     */
    public function __construct()
    {
//        $this->imageUploadedPath  = $this->getImageRootPath() . topicImagePath();
    }

    public function transform($pharmaceutical) {

        return [
            'id'                        => $pharmaceutical->id,
            'name'                      => $pharmaceutical->name,
            'registrationNumber'        => $pharmaceutical->registration_number,
            'phone'                     => $pharmaceutical->phone,
            'email'                     => $pharmaceutical->email,
            'address'                   => $pharmaceutical->address,
            'companyType'               => $pharmaceutical->company_type,
//            'description'       => $this->formatHtml($pharmaceutical->description),
//            'imagePath'        => ($pharmaceutical->image_path != null) ? $this->imageUploadedPath . $pharmaceutical->image_path : null,
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
