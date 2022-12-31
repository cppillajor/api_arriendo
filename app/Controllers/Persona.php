<?php

namespace App\Controllers;

use App\Models\PersonaModel;
use CodeIgniter\RESTful\ResourceController;

class Persona extends ResourceController
{

    public function login()
    {

        try {
            $usuario=$this->request->getPost('usuario');
            $password=$this->request->getPost('password');
            $persona_model=new  PersonaModel();
            $datos=[];
            $datos=$persona_model->getloginusuario($usuario,$password);
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }
            $datos=$persona_model->getlogincorreo($usuario,$password);
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, 'No hay datos', 404);
            }


        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

        
    }

    public function index($id =null)        
    {        

        try {
            $persona_model=new  PersonaModel();
            $datos=$persona_model->getPersonas();
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
            $per_id=$this->request->getPost('id');
            $persona_model=new  PersonaModel();

            $datos=array(
                "per_estado"=>0,
            );            
            $persona_model->eliminar($per_id,$datos);           
            return $this->genericResponse("Eliminado con exito", null, 200);  

            /*=====  End of Eliminar ======*/
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
    }
    public function show($id = null)
    {
        try {
            $per_id=$this->request->getPost('per_id');

            $persona_model=new  PersonaModel();
            
            $datos=$persona_model->getUnaPersonas($per_id);
            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
            }else{
                return $this->genericResponse(null, "No hay datos", 404);
            }   

            /*=====  End of Eliminar ======*/
        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
    }

    public function create()
    {

        try {
            $per_nombre=$this->request->getPost('nombre');
            $per_apellido=$this->request->getPost('apellido');
            $per_direccion=$this->request->getPost('direccion');
            $per_telefono=$this->request->getPost('telefono');
            $per_correo=$this->request->getPost('correo');
            $per_imagen=$this->request->getPost('imagen');
            $per_usuario=$this->request->getPost('usuario');
            $per_password=$this->request->getPost('password');
            
            $datos =array(
                "per_nombre"=> $per_nombre,
                "per_apellido"=> $per_apellido,
                "per_direccion"=> $per_direccion,
                "per_telefono"=> $per_telefono,
                "per_correo"=> $per_correo,
                "per_imagen"=> $per_imagen,
                "per_usuario"=> $per_usuario,
                "per_password"=> $per_password,
                "per_rol"=> 3,
                "per_estado"=> 1,
            );
            
            
            $persona_model=new  PersonaModel();
            $persona_model->insertar($datos);   

            return $this->genericResponse("Ingresado con exito",null, 200);     

        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }
        
        
    }

    public function update($id = null)
    {
        try {
            $per_id=$this->request->getPost('id');
            $per_nombre=$this->request->getPost('nombre');
            $per_apellido=$this->request->getPost('apellido');
            $per_direccion=$this->request->getPost('direccion');
            $per_telefono=$this->request->getPost('telefono');
            $per_correo=$this->request->getPost('correo');
            $per_imagen=$this->request->getPost('imagen');
            $per_usuario=$this->request->getPost('usuario');
            $per_password=$this->request->getPost('password');
            
            $datos =array(
                "per_nombre"=> $per_nombre,
                "per_apellido"=> $per_apellido,
                "per_direccion"=> $per_direccion,
                "per_telefono"=> $per_telefono,
                "per_correo"=> $per_correo,
                "per_imagen"=> $per_imagen,
                "per_usuario"=> $per_usuario,
                "per_password"=> $per_password,
            );
            
            
            $persona_model=new  PersonaModel();
            $persona_model->actualizar($per_id,$datos);
            return $this->genericResponse("Editado con exito",null, 200); 


        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

    }

    public function asignarrol($id = null)
    {
        try {
            $per_id=$this->request->getPost('per_id');
            $per_rol=$this->request->getPost('per_rol');
            
            
            $datos =array(
                "per_rol"=> $per_rol,
            );
            
            
            $persona_model=new  PersonaModel();
            $persona_model->actualizar($per_id,$datos);
            return $this->genericResponse("Editado con exito",null, 200); 


        } catch (Exception $e) {  

            return $this->genericResponse(null, $e->getMessage(), 404);
        }

    }

    public function comprobarcorreousuario()
    {
        try {
            $per_correo=$this->request->getPost('per_correo');
            $per_usuario=$this->request->getPost('per_usuario');
            
            
            $persona_model=new  PersonaModel();

            $datos=$persona_model->comprobarcorreousuario($per_correo,$per_usuario);

            if(!empty($datos)){
                return $this->genericResponse($datos, null, 200);
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