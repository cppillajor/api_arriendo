<?php

namespace App\Controllers;

use App\Models\EnArriendoModel;
use CodeIgniter\RESTful\ResourceController;

class EnArriendo extends ResourceController
{
    
    public function index()
    {

        try {
            $ajustes_centavos_model=new  AjustesCentavosModel();
            $datos=$ajustes_centavos_model->getAjustesCentavos();
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }           

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

        
    }

    public function show($id =null)        
    {        

        try {
            $ea_id_persona_arrendatario=$this->request->getPost('ea_id_persona_arrendatario');
            
            $en_arriendo_model=new  EnArriendoModel();
            $datos=$en_arriendo_model->getEnArriendoArrendatario($ea_id_persona_arrendatario);
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }   
            /*=====  End of Busqueda  ======*/
            
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
    }

    public function delete($id = null)
    {
        try {
            $ea_id=$this->request->getPost('ea_id');

            $datos=array(
                "ea_estado"=>0,
            );            
            $en_arriendo_model=new  EnArriendoModel();
            $en_arriendo_model->eliminar($ea_id,$datos);           
            return $this->genericResponse("Eliminado con exito", null, 200);  

            /*=====  End of Eliminar ======*/
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
    }

    public function create()
    {

        try {
            
                        
            $ea_id_persona_solicitante=$this->request->getPost('ea_id_persona_solicitante');
            $ea_id_persona_arrendatario=$this->request->getPost('ea_id_persona_arrendatario');
            $ea_id_inmueble=$this->request->getPost('ea_id_inmueble');
            
            $datos =array(
                "ea_id_persona_solicitante"=> $ea_id_persona_solicitante,
                "ea_id_persona_arrendatario"=> $ea_id_persona_arrendatario,
                "ea_id_inmueble"=> $ea_id_inmueble,
                "ea_estado"=> 1,
            );
            
            
            $en_arriendo_model=new  EnArriendoModel();
            $en_arriendo_model->insertar($datos);   

            return $this->genericResponse("Ingresado con exito",null, 200);     

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
        
    }

    public function update($ajc_id = null)
    {
        try {
            /*=============================================
            =            Recoger datos Ingresados            =
            =============================================*/
            $datos_ingresado = $this->request->getRawinput();            
            $ajc_valor_movimiento=$datos_ingresado['ajc_valor_movimiento'];
            $ajc_cuenta_contable=$datos_ingresado['ajc_cuenta_contable'];
            $ajc_fecha_contable=$datos_ingresado['ajc_fecha_contable'];
            $ajc_referencia_contable=$datos_ingresado['ajc_referencia_contable'];
            $ajc_observacion=$datos_ingresado['ajc_observacion'];
            $ajc_oficina=$datos_ingresado['ajc_oficina'];
            $ajc_sucursal=$datos_ingresado['ajc_sucursal'];
            $ajc_fecha_registro=$datos_ingresado['ajc_fecha_registro'];
            $ajc_centro_costo=$datos_ingresado['ajc_centro_costo'];
            $ajc_numero_comprobante =$datos_ingresado['ajc_numero_comprobante'];
            $ajc_usuario=$datos_ingresado['ajc_usuario'];
            $ajc_estado=$datos_ingresado['ajc_estado'];
            
            /*=====  End of Section Recoger datos Ingresados  ======*/

           
            /*===================================================
            =            Compactar datos en un array            =
            ===================================================*/
            
            $datos =array(
                "ajc_valor_movimiento"=> $ajc_valor_movimiento,
                "ajc_cuenta_contable"=> $ajc_cuenta_contable,
                "ajc_fecha_contable"=> $ajc_fecha_contable,
                "ajc_referencia_contable"=> $ajc_referencia_contable,
                "ajc_observacion"=> $ajc_observacion,
                "ajc_oficina"=> $ajc_oficina,
                "ajc_sucursal"=> $ajc_sucursal,
                "ajc_fecha_registro"=> $ajc_fecha_registro,
                "ajc_centro_costo"=> $ajc_centro_costo,
                "ajc_numero_comprobante"=> $ajc_numero_comprobante,
                "ajc_usuario"=> $ajc_usuario,
                "ajc_estado"=> $ajc_estado,                
            );
            
            /*=====  End of Compactar datos en un array  ======*/
            
            /*========================================================================
            =            Validar Valores para el ingreso el base de datos            =
            ========================================================================*/
            
            $validation =  \Config\Services::validation();
            $validation->setRules([
                
                "ajc_valor_movimiento"=> 'required',
                "ajc_cuenta_contable"=> 'required',
                "ajc_fecha_contable"=> 'required|valid_date',
                "ajc_referencia_contable"=> 'required',
                "ajc_observacion"=> 'required',
                "ajc_oficina"=> 'required',
                "ajc_sucursal"=> 'required',
                "ajc_fecha_registro"=> 'required|valid_date',
                "ajc_centro_costo"=> 'required',
                "ajc_numero_comprobante"=> 'required|numeric',
                "ajc_usuario"=> 'required',
                "ajc_estado"=> 'required|numeric',               
            ]);
            $validation->withRequest($this->request)->run();
            if($validation->getErrors()){
                $errores = $validation->getErrors();                 
                return $this->genericResponse(null, $errores, 404);
            }
            
            /*=====  End of Validar Valores para el ingreso el base de datos  ======*/
            
            /*======================================
            =            actualizar datos            =
            ======================================*/
            $ajustes_centavos_model=new  AjustesCentavosModel();
            $ajustes_centavos_model->actualizar($ajc_id,$datos);           
            
            /*=====  End of actualizar datos  ======*/        
            $existente=$ajustes_centavos_model->getAjusteCentavo($ajc_id);
            if(!empty($existente)){
                return $this->genericResponse($existente, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }       
            
                

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

    }

    private function genericResponse($data, $msj, $code)
    {

        if ($code == 200) {
            return $this->respond(array(
                "data" => $data,
                "code" => $code
            )); //, 404, "No hay nada"
        } else {
            return $this->respond(array(
                "msj" => $msj,
                "code" => $code
            ));
        }
    }
}