<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class TipoInmuebleModel extends Model
{
    public function getcomprobarsolicitud($sr_id_persona)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_solicitud_rol');
        $builder->select('tbl_solicitud_rol.*');
        $builder->where('tbl_solicitud_rol.sr_id_persona', $sr_id_persona);      
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function getTipoInmueble()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_tipo_inmueble');
        $builder->select('tbl_tipo_inmueble.*');
        $builder->where('tbl_tipo_inmueble.tin_estado', 1);      
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function getcomprobarrepetido($sa_id_persona_solicitante,$sa_id_inmueble)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_solicitud_arriendo');
        $builder->select('tbl_solicitud_arriendo.*');    
        $builder->where('tbl_solicitud_arriendo.sa_id_persona_solicitante', $sa_id_persona_solicitante);  
        $builder->where('tbl_solicitud_arriendo.sa_id_inmueble', $sa_id_inmueble);  
        $builder->where('tbl_solicitud_arriendo.sa_estado', 1);        
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function insertar($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_tipo_inmueble');
        $builder->set($data);
		$builder->insert();

    }
    public function actualizar($tin_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_tipo_inmueble');
        $builder->where('tbl_tipo_inmueble.tin_id', $tin_id);
		return $builder->update($data);        
    }
    public function eliminar($tin_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_tipo_inmueble');
        $builder->where('tbl_tipo_inmueble.tin_id', $tin_id);   
		$builder->update($data);        
    }

}