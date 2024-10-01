<?php
namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class DiseaseTransformer extends Transformer
{
    public function transform($disease) {

        return [
            'id'            => $disease->id,
//            'category_id'   => $disease->disease_category_id,
            'code'          => $disease->code_name,
            'name'          => $disease->code_description,
        ];
    }
}
