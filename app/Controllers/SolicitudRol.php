<?php

namespace App\Controllers;

use App\Models\SolicitudRolModel;
use CodeIgniter\RESTful\ResourceController;

class SolicitudRol extends ResourceController
{

    public function comprobarsolicitudenviadaidpersona()
    {

        try {
            $sr_id_persona=$this->request->getPost('sr_id_persona');

            $solicitud_rol_model=new  SolicitudRolModel();

            $datos=$solicitud_rol_model->getcomprobarsolicitud($sr_id_persona);
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }           

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

        
    }
    public function index()
    {

        try {

            $solicitud_rol_model=new  SolicitudRolModel();
            
            $datos=$solicitud_rol_model->getSolicitudRol();
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }           

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

        
    }

   

    public function delete($id = null)
    {
        try {
            $sr_id=$this->request->getPost('sr_id');

            $datos=array(
                "sr_estado"=>0,
            );            
            $solicitud_rol_model=new  SolicitudRolModel();
            $solicitud_rol_model->eliminar($sr_id,$datos);           
            return $this->genericResponse("Eliminado con exito", null, 200);  

            /*=====  End of Eliminar ======*/
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
    }

    public function create()
    {

        try {

            $sr_id_persona=$this->request->getPost('sr_id_persona');
            $sr_descripcion=$this->request->getPost('sr_descripcion');

            
            $datos =array(
                "sr_id_persona"=> $sr_id_persona,
                "sr_descripcion"=> $sr_descripcion,
                "sr_estado"=> 1,
            );
            
            
            $solicitud_rol_model=new  SolicitudRolModel();
            $solicitud_rol_model->insertar($datos);   

            return $this->genericResponse("Ingresado con exito",null, 200);     

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
        
    }

    public function update($id = null)
    {
        try {
            $ipm_id=$this->request->getPost('ipm_id');
            $ipm_fecha_pago=$this->request->getPost('ipm_fecha_pago');
            $ipm_valor_mensual=$this->request->getPost('ipm_valor_mensual');
            
            $datos =array(
                "ipm_fecha_pago"=> $ipm_fecha_pago,
                "ipm_valor_mensual"=> $ipm_valor_mensual,
                "ipm_estado"=> 1,
            );
            
            
            $inmueble_pago_mensual_model=new  InmueblePagoMensualModel();
            $inmueble_pago_mensual_model->actualizar($ipm_id,$datos);   

            return $this->genericResponse("editado con exito",null, 200);
            


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