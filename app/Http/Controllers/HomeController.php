<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Conekta\lib\Conekta;

class HomeController extends Controller
{
    private $ApiKey="";
    public function index()
    {
        return view('home');
    }

    public function realizarPago(Request $request)
    {
        $this->setapiKey($this->ApiKey);
        $datos = $request->all();
        if(!$this->crearCliente($datos))
        {
            return false;
        }
        else if(!$this->crearOrden($datos))
        {
            return false;
        }

        return true;
       

        
    }

    public function generarComprobante()
    {
        return true;
    }

    public function CrearOrden($datos)
    {
        try{
         
            $datos_cliente = 
              array(
                "amount"=>$datos['datos_info']['importe'],
                "line_items" => array(
                  array(
                    "name" => $datos['datos_info']['concepto'],
                    "unit_price" => $datos['datos_info']['importe']*100, //se multiplica por 100 conekta
                    "quantity" => 1
                  )
                ), 
                "currency" => "MXN",
                "customer_info" => array(
                  "customer_id" => "customer_id"
                ), //customer_info
                "charges" => array(
                    array(
                        "payment_method" => array(
                                "type" => "default"
                        ) 
                    ) 
                ) 
              );
          } catch (\Throwable $th){
            return false;
          } 
    
          return true;
    }

    public function CrearCliente($datos)
    {
        try {
            $datos_orden = array(
                "name" => $datos['datos_tarjeta']['card']['name'],
                "email" => 'usuario@email.com',
                "phone" => $datos['datos_info']['number_phone'],
                "payment_sources" => array(
                  array(
                      "type" => "card",
                      "token_id" => "token",
                  )
                )
              );
          } catch (\Throwable $th){
            return false;
          } 
    
          return true;
    }

    public function setApiKey($api_key)
    {
        return true;
    }
}


