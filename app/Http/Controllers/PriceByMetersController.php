<?php

namespace App\Http\Controllers;

use App\Http\Extensions\GobGetFilesService;
use App\Http\Requests\GetByZipAggregateTypeRequest;
use App\Http\Responses\GetByZipAggregateTypeResponse;
use App\Models\Propierties;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

class PriceByMetersController
{

    protected $zipCode;
    protected $operation;
    protected $constructionType;
    protected $filesService;

    /**
     *
     * @param  string $zipCode
     * @param  string $operation
     * @param  int  $constructionType
     * @return void
     */
    public function __construct(GetByZipAggregateTypeRequest $request, GobGetFilesService $filesService)
    {
        $this->constructionType = $request->get('construction_type');
        $this->filesService = $filesService;
    }

    /**
     * @return GetByZipAggregateTypeResponse
     */
    public function getByZipAggregateType($zipCode, $aggretate): GetByZipAggregateTypeResponse
    {
        $this->zipCode = $zipCode;
        $this->operation = $aggretate;

        //todo:
        //$this->getOriginData();
        //$this->storageResultData();

        $result = $this->construcResponse();

        return new GetByZipAggregateTypeResponse($result);
    }

    private function getOriginData()
    {
        $this->filesService->getData(config('challengeSpot2.gob_particular_service_gam'));
    }

    private function storageResultData()
    {
        $this->filesService->storageFileData();
    }

    private function construcResponse()
    {
        $propierties = Propierties::where('codigo_postal',$this->zipCode)
            ->where('uso_construccion', config('constants.construction_type.'.$this->constructionType))
            ->get()->all();
        $result = [
            'payload' =>
                [
                    "type" => $this->operation,
                    "price_unit" => $this->getUnitPrice($propierties),
                    "price_unit_construction" => $this->getUnitPriceConstruction($propierties),
                    "elements" => count($propierties),
                ]
        ];

        return $result;
    }

    /**
     * @param $land_surface
     * @param $land_value
     * @param $subsidy
     * @return float|int
     */
    private function getUnitPrice($propierties)
    {
        if(count($propierties ) == 0)
            return 0;

        $land_surface = $this->calculate('superficie_terreno',$propierties);
        $land_value = $this->calculate('valor_suelo',$propierties);
        $subsidy = $this->calculate('subsidio',$propierties);

        return ($land_surface / $land_value) - $subsidy;
    }

    /**
     * @param $surface_construction
     * @param $land_value
     * @param $subsidy
     * @return float|int
     */
    private function getUnitPriceConstruction($propierties)
    {
        if(count($propierties ) == 0)
            return 0;

        $surface_construction = $this->calculate('superficie_construccion',$propierties);
        $land_value = $this->calculate('valor_suelo',$propierties);
        $subsidy =$this->calculate('subsidio',$propierties);
        return ($surface_construction / $land_value) - $subsidy;
    }

    /**
     * @param $col
     * @param $propierties
     * @return mixed|void
     */
    private function calculate($col, $propierties)
    {
        switch ($this->operation)
        {
            case 'sum': return collect($propierties)->sum($col);
            case 'ave': return collect($propierties)->average($col);
            case 'max': return collect($propierties)->max($col);
        }
    }
}
