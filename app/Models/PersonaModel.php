<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class PersonaModel extends Model
{
    public function getloginusuario($usuario,$clave)
    
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->select('tbl_persona.*');
        $builder->where('tbl_persona.per_usuario', $usuario);  
        $builder->where('tbl_persona.per_password',$clave);  
        $builder->where('tbl_persona.per_estado',1);  
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function getlogincorreo($correo,$clave)    
    {
       
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->select('tbl_persona.*');
        $builder->where('tbl_persona.per_correo',$correo);  
        $builder->where('tbl_persona.per_password',$clave); 
        $builder->where('tbl_persona.per_estado',1);  
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function comprobarcorreousuario($correo,$usuario)
    
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->select('tbl_persona.*'); 
        $builder->where('tbl_persona.per_usuario', $usuario); 
        $builder->orwhere('tbl_persona.per_correo',$correo);  
        $builder->where('tbl_persona.per_estado',1);  
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    


    public function getPersonas()    
    {
       
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->select('tbl_persona.*,tbl_rol.*');
        $builder->join('tbl_rol', 'tbl_persona.per_rol=tbl_rol.rol_id');
        $builder->where('tbl_persona.per_estado',1);  
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function getUnaPersonas($per_id)    
    {
       
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->select('tbl_persona.*');
        $builder->where('tbl_persona.per_id', $per_id);
        $builder->where('tbl_persona.per_estado',1);  
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function insertar($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->set($data);
		$builder->insert();

    }
    public function actualizar($per_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->where('tbl_persona.per_id', $per_id);
		return $builder->update($data);        
    }
    public function eliminar($per_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_persona');
        $builder->where('tbl_persona.per_id', $per_id);   
		$builder->update($data);        
    }

}