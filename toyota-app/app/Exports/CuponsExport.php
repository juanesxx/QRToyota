<?php

namespace App\Exports;

use App\Models\Cupon;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;


class CuponsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {

        if(Auth::user()->hasRole('admin')){
            return [
                'Placa',
                'Estado',
                'Ciudad',
                'Quien',
                'Creado',
                'Actualizado',
            ];
        } else if(Auth::user()->hasRole('rol2')){
            return [
                'Placa',
                'Estado',
                'Ciudad',
                'Quien',
                'Creado',
                'Actualizado',
            ];
        }
    }
    public function collection()
    {
        if(Auth::user()->hasRole('admin')){
            $cupons = Cupon::all();
            foreach($cupons as $cupon){
                if($cupon->enabled == 1){
                    $cupon->enabled = "Sin redimir";
                }else if($cupon->enabled == 0){
                    $cupon->enabled = "Redimido";
                }
            }
            return $cupons;
        } else if(Auth::user()->hasRole('rol2')){
            $cupons = DB::table('cupons')->where('enabled', 0)->get();
            foreach($cupons as $cupon){
                if($cupon->enabled == 0){
                    $cupon->enabled = "Redimido";
                }
            }
            return $cupons;
        }

    }
}