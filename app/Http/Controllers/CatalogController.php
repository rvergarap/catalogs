<?php

namespace App\Http\Controllers;

use App\Integrator;
use App\CatalogProduct;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class CatalogController extends Controller
{

    public function showAllCatalogs(Request $request)
    {
        // TODO: Validate id
        $id = (int)$request->id;
        $data = Integrator::with('clients.catalogs.products')->findOrFail($id);
        return response()->json($data);
    }

    public function updateStock($idc,$idp, Request $request)
    {
        // TODO: Validar los parametros

        $cp = CatalogProduct::where('catalog_id','=',$idc)
                ->where('product_id','=',$idp)->first();

        $cs = $cp->current_stock;
        $ms = $cp->max_stock;
        $quantity = (int)$request->quantity;
        $newStock = $cs + $quantity;

        if($quantity<0 and $newStock<0){
            $message = "ALERTA: NO HAY STOCK SUFICIENTE, SOLO " . $cs . " UNIDADES";
            return $message;
        }elseif ($quantity>0 and $newStock > $ms){
            $message = "ALERTA: PARA NO SOBREPASAR EL STOCK MAXIMO, SE PUEDE PEDIR A LO MAS " . ($ms - $cs) . " UNIDADES";
            return $message;
        }elseif ($quantity==0){
            $message = "ALERTA: EL VALOR INGRESADO NO ES VÁLIDO";
            return $message;
        }


        DB::table('catalog_product')
            ->where('catalog_id',$idc)
            ->where('product_id',$idp)->limit(1)
            ->update(['current_stock' => $newStock]);

        
        $message = (true)?"INFO: STOCK ACTUALIZADO CORRECTAMENTE":"NOK";

        if($cs==0) $message .= "<br/>NOTIFICACIÓN: YA HAY STOCK DEL PRODUCTO NUEVAMENTE";
        return $message;
    }
}