<?php

namespace App\Api\Transformers\V1;

use App\Api\Transformers\Transformer;

class MedicineTransformer extends Transformer
{
    protected $pharmaceuticalTransformer;
    protected $units;
    /**
     * MedicineTransformer constructor.
     * @param PharmaceuticalCompanyTransformer $pharmaceuticalTransformer
     */
    public function __construct(PharmaceuticalCompanyTransformer $pharmaceuticalTransformer)
    {
        $this->pharmaceuticalTransformer = $pharmaceuticalTransformer;
        $this->units    =   [];
    }

    public function transform($medicine) {

        return [
            'id'                       => $medicine->id,
            'code'                     => $medicine->code,
            'name'                     => $medicine->name,
            'description'              => $this->formatHtml($medicine->description),
            'strength'                 => trim($medicine->strength),
            /*'strength'                 => $this->formatStrength(trim($medicine->strength)),
            'units'                    => $this->units,*/
            'indications'              => trim($medicine->indications_details),
            'administration'           => $medicine->administration,
            'ingredients'              => $medicine->ingredients,
            'contraindications'        => $medicine->contraindications,
            'sideEffects'              => $medicine->side_effects,
            'precautions'              => $medicine->precautions,
            'pregnancyCategory'        => $medicine->pregnancy_category,
            'modeOfActions'            => $medicine->mode_of_actions,
            'interactions'             => $medicine->interactions,
            'genericName'              => $medicine->generic_name,
            'medicineType'             => $medicine->medicine_type_name,
            'therapeuticClass'         => $medicine->therapeutic_class_names,
            'pharmaceuticalCompany'    => $this->getPharmaceuticalInfo($medicine->pharmaceutical),
            'packetInfo'               => $this->getPacketInfo($medicine->pack_size, $medicine->no_per_unit, $medicine->unit_price, $medicine->currency),
            'dosageInfo'               => $this->getDoseInfo($medicine->adult_dose, $medicine->child_dose, $medicine->renal_dose),
            'indicationsKeywords'      => $this->getKeyWords($medicine->indications_keywords)
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

    public function getPharmaceuticalInfo($pharma) {
        if($pharma == null) {
            $pharmaceutical = null;
        } else {
            $pharmaceutical = $this->pharmaceuticalTransformer->transform($pharma);
        }

        return $pharmaceutical;
    }

    public function getDoseInfo($adultDose, $childDose, $renalDose) {
        $doseInfoArray = [
            'adultDose'        => $adultDose,
            'childDose'        => $childDose,
            'renalDose'        => $renalDose
        ];

        return $doseInfoArray;
    }

    public function getPacketInfo($packSize, $noPerUnit, $unitPrice, $currency) {
        $packetInfoArray = [
            'packSize'         => $packSize,
            'noPerUnit'       => $noPerUnit,
            'unitPrice'        => $unitPrice,
            'currency'          => $currency
        ];

        return $packetInfoArray;
    }

    public function getKeyWords($keyWords) {
        if($keyWords !== null) {
            $keyWords = explode(',', $keyWords);
        }

        return $keyWords;
    }

    public function getTherapeuticClass($keyWords) {
        if($keyWords !== null) {
            $keyWords = explode(',', $keyWords);
        }

        return $keyWords;
    }

    protected function formatStrength($strengthData) {
        $medicineData = explode('+',$strengthData);

        $strengthList   =   [];
        $this->units    =   [];
        foreach ($medicineData as $medicine) {
            $strengthDetails = explode(' ', trim($medicine),2);
            if (!in_array(trim($strengthDetails[0]), $strengthList)) {
                $strengthList[]=$strengthDetails[0];
            }

            if (in_array(trim($strengthDetails[1]), $this->units)) {
                continue;
            }
            $this->units[]=trim($strengthDetails[1]);
        }

        return $strengthList;
    }
}
