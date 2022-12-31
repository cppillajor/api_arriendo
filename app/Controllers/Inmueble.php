<?php

namespace App\Controllers;

use App\Models\InmuebleModel;
use CodeIgniter\RESTful\ResourceController;

class Inmueble extends ResourceController
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

    public function seleccionarseguntipoinmueble($id =null)        
    {        

        try {
            $in_id_tipo_inmueble=$this->request->getPost('id');
            $inmueble_model=new  InmuebleModel();
            $datos=$inmueble_model-> getseguntipoinmueble($in_id_tipo_inmueble);
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
    public function show($id =null)        
    {        

        try {
            $in_id=$this->request->getPost('id');
            $inmueble_model=new  InmuebleModel();
            $datos=$inmueble_model-> getUnInmueble($in_id);
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
    public function selectsegunidpersona($id =null)        
    {        

        try {
            $in_id_persona=$this->request->getPost('id');
            $inmueble_model=new  InmuebleModel();
            $datos=$inmueble_model->getsegunidpersona($in_id_persona);
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
            $in_id=$this->request->getPost('in_id');

            $datos=array(
                "in_estado"=>0,
            );            
            $inmueble_model=new  InmuebleModel();
            $inmueble_model->eliminar($in_id,$datos);           
            return $this->genericResponse("Eliminado con exito", null, 200);  

            /*=====  End of Eliminar ======*/
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
    }

    public function create()
    {

        try {
            $in_id_tipo_inmueble=$this->request->getPost('in_id_tipo_inmueble');
            $in_id_persona=$this->request->getPost('in_id_persona');
            $in_descripcion=$this->request->getPost('in_descripcion');
            $in_direccion=$this->request->getPost('in_direccion');
            $in_num_cuarto=$this->request->getPost('in_num_cuarto');
            $in_num_baño=$this->request->getPost('in_num_baño');
            $in_num_sala=$this->request->getPost('in_num_sala');
            $in_num_cocina=$this->request->getPost('in_num_cocina');
            $in_num_parqueadero=$this->request->getPost('in_num_parqueadero');
            $in_inmueble_amoblado=$this->request->getPost('in_inmueble_amoblado');
            $in_tamaño=$this->request->getPost('in_tamaño');
            $in_contrato=$this->request->getPost('in_contrato');
            $in_precio_inmueble=$this->request->getPost('in_precio_inmueble');
            $in_imagen=$this->request->getPost('in_imagen');
            $in_latitud=$this->request->getPost('in_latitud');
            $in_longitud=$this->request->getPost('in_longitud');
            
            
            $datos =array(
                "in_id_tipo_inmueble"=> $in_id_tipo_inmueble,
                "in_id_persona"=> $in_id_persona,
                "in_descripcion"=> $in_descripcion,
                "in_direccion"=> $in_direccion,
                "in_num_cuarto"=> $in_num_cuarto,
                "in_num_baño"=> $in_num_baño,
                "in_num_sala"=> $in_num_sala,
                "in_num_cocina"=> $in_num_cocina,
                "in_num_parqueadero"=> $in_num_parqueadero,
                "in_inmueble_amoblado"=> $in_inmueble_amoblado,
                "in_tamaño"=> $in_tamaño,
                "in_contrato"=> $in_contrato,
                "in_precio_inmueble"=> $in_precio_inmueble,
                "in_imagen"=> $in_imagen,
                "in_latitud"=> $in_latitud,
                "in_longitud"=> $in_longitud,
                "in_estado"=> 1,
            );
            
            
            $inmueble_model=new  InmuebleModel();
            $inmueble_model->insertar($datos);   

            return $this->genericResponse("Ingresado con exito",null, 200);     

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
        
    }

    public function update($id = null)
    {
        try {
            $in_id=$this->request->getPost('in_id');
            $in_id_tipo_inmueble=$this->request->getPost('in_id_tipo_inmueble');
            $in_id_persona=$this->request->getPost('in_id_persona');
            $in_descripcion=$this->request->getPost('in_descripcion');
            $in_direccion=$this->request->getPost('in_direccion');
            $in_num_cuarto=$this->request->getPost('in_num_cuarto');
            $in_num_baño=$this->request->getPost('in_num_baño');
            $in_num_sala=$this->request->getPost('in_num_sala');
            $in_num_cocina=$this->request->getPost('in_num_cocina');
            $in_num_parqueadero=$this->request->getPost('in_num_parqueadero');
            $in_inmueble_amoblado=$this->request->getPost('in_inmueble_amoblado');
            $in_tamaño=$this->request->getPost('in_tamaño');
            $in_contrato=$this->request->getPost('in_contrato');
            $in_precio_inmueble=$this->request->getPost('in_precio_inmueble');
            $in_imagen=$this->request->getPost('in_imagen');
            $in_latitud=$this->request->getPost('in_latitud');
            $in_longitud=$this->request->getPost('in_longitud');
            
            
            $datos =array(
                "in_id_tipo_inmueble"=> $in_id_tipo_inmueble,
                "in_id_persona"=> $in_id_persona,
                "in_descripcion"=> $in_descripcion,
                "in_direccion"=> $in_direccion,
                "in_num_cuarto"=> $in_num_cuarto,
                "in_num_baño"=> $in_num_baño,
                "in_num_sala"=> $in_num_sala,
                "in_num_cocina"=> $in_num_cocina,
                "in_num_parqueadero"=> $in_num_parqueadero,
                "in_inmueble_amoblado"=> $in_inmueble_amoblado,
                "in_tamaño"=> $in_tamaño,
                "in_contrato"=> $in_contrato,
                "in_precio_inmueble"=> $in_precio_inmueble,
                "in_imagen"=> $in_imagen,
                "in_latitud"=> $in_latitud,
                "in_longitud"=> $in_longitud,
                "in_estado"=> 1,
            );
            
            
            $inmueble_model=new  InmuebleModel();
            $inmueble_model->actualizar($in_id,$datos);
            return $this->genericResponse("Editado con exito",null, 200);     

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