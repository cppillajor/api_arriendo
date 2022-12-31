<?php

namespace App\Controllers;

use App\Models\TipoInmuebleModel;
use CodeIgniter\RESTful\ResourceController;

class TipoInmueble extends ResourceController
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

            $tipo_inmueble_model=new  TipoInmuebleModel();
            
            $datos=$tipo_inmueble_model->getTipoInmueble();
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
            $tin_id=$this->request->getPost('id');

            $datos=array(
                "tin_estado"=>0,
            );            
            $tipo_inmueble_model=new  TipoInmuebleModel();
            $tipo_inmueble_model->eliminar($tin_id,$datos);           
            return $this->genericResponse("Eliminado con exito", null, 200);  

            /*=====  End of Eliminar ======*/
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
    }

    public function create()
    {

        try {

            $tin_nombre=$this->request->getPost('tin_nombre');
            $tin_descripcion=$this->request->getPost('tin_descripcion');
            $tin_imagen=$this->request->getPost('tin_imagen');

            $datos =array(
                "tin_nombre"=> $tin_nombre,
                "tin_descripcion"=> $tin_descripcion,
                "tin_imagen"=> $tin_imagen,
                "tin_estado"=> 1,
            );
            
            
            $tipo_inmueble_model=new  TipoInmuebleModel();
            $tipo_inmueble_model->insertar($datos);   

            return $this->genericResponse("Ingresado con exito",null, 200);     

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
        
    }

    public function update($id = null)
    {
        try {
            $tin_id=$this->request->getPost('id');
            $tin_nombre=$this->request->getPost('tin_nombre');
            $tin_descripcion=$this->request->getPost('tin_descripcion');
            $tin_imagen=$this->request->getPost('tin_imagen');

            $datos =array(
                "tin_nombre"=> $tin_nombre,
                "tin_descripcion"=> $tin_descripcion,
                "tin_imagen"=> $tin_imagen,
                "tin_estado"=> 1,
            );
            
            
            $tipo_inmueble_model=new  TipoInmuebleModel();
            $tipo_inmueble_model->actualizar($tin_id,$datos);   

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