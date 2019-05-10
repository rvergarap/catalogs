<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Client;
use App\Product;
use App\CatalogProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class CatalogController extends Controller
{

    public function showAllCatalogs()
    {
        //$data = Client::with('catalogs','products')->get();
        //$data = Catalog::with('products')->findOrFail(1);
        //$data = Client::with('catalogs')->findOrFail(1);

        $data = DB::table('integrator_client')
            ->select('client.*','catalog.name')
            ->join('client','client.id','=','integrator_client.client_id')
            ->join('catalog','catalog.client_id','=','client.id')

            ->where(['integrator_client.integrator_id' => '1'])
            ->get();
        return new JsonResponse($data);
        //return response()->json(Client::all());
    }

    public function showOneCatalog($idc,$idp, Request $request)
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

/*
        $cp->current_stock = $newStock;
        $cp->update();
*/
/*
        DB::table('catalog_product')
            ->update('current_stock', $newStock)
            ->where(['catalog_id' => $idc,'product_id' => $idp]);
*/
        DB::table('catalog_product')
            ->where('catalog_id',$idc)
            ->where('product_id',$idp)->limit(1)
            ->update(['current_stock' => $newStock])
        ;

/*
        CatalogProduct::where('catalog_id','=',$idc)
            ->where('product_id','=',$idp)->first()->update(['current_stock' => $newStock]);
        */
        
        $message = (true)?"INFO: STOCK ACTUALIZADO CORRECTAMENTE":"NOK";

        if($cs==0) $message .= "<br/>NOTIFICACIÓN: YA HAY STOCK DEL PRODUCTO NUEVAMENTE";
        return $message;
    }

    public function create(Request $request)
    {
        $catalog = Catalog::create($request->all());

        return response()->json($catalog, 201);
    }

    public function update($id, Request $request)
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->update($request->all());

        return response()->json($catalog, 200);
    }

    public function delete($id)
    {
        Catalog::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

    protected $primaryKey = ['user_id', 'stock_id'];
    public $incrementing = false;

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}