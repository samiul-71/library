<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class ChronicDiseaseTransformer extends Transformer
{
    public function transform($disease) {

        return [
            'id'                    => $disease->id,
            'disease_name'          => $disease->disease_name,
            'disease_description'   => $disease->disease_description,
        ];
    }
}
