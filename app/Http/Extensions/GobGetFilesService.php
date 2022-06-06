<?php

namespace App\Http\Extensions;

use App\Models\propierties;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GobGetFilesService
{
    private $file;

    /**
     * @param $url
     */
    public function getData($url){
        //todo: Resolver problema de sertificado ssl
        /*$response = Http::get($url);
        $this->file = Storage::disk('local')->put($response->file, 'Contents');*/
    }

    public function storageFileData(){
        $path = public_path().'\files\sig_cdmx_GUSTAVO A. MADERO_08-2020.csv';
        $spreadsheet = IOFactory:: load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $this->parseExcel($worksheet);
        Propierties::save($data);
    }

    private function parseExcel(Worksheet $worksheet)
    {
        foreach ($worksheet->getRowIterator(2) as $row) {
            if($row->getColumnIndex('D') > 0){
                $_data[] = $this->rowMapper($row);
            }
        }
        return $_data;
    }

    private function rowMapper($row)
    {
        return [
            'codigo_postal'             => substr('00000'.$row->getColumnIndex('D') , -5),
            'superficie_terreno'        => $row->getColumnIndex('F'),
            'superficie_construccion'   => $row->getColumnIndex('G'),
            'uso_construccion'          => config('constants.construction_type'.$row->getColumnIndex('H')),
            'valor_unitario_suelo'      =>$row->getColumnIndex('L'),
            'valor_suelo'               =>$row->getColumnIndex('M'),
            'subsidio'                  =>$row->getColumnIndex('Q')
        ];
    }

}
