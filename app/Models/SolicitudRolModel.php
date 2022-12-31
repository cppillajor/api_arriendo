<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class SolicitudRolModel extends Model
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
    public function getSolicitudRol()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_solicitud_rol');
        $builder->select('tbl_solicitud_rol.*, tbl_persona.*');
        $builder->join('tbl_persona', 'tbl_solicitud_rol.sr_id_persona=tbl_persona.per_id'); 
        $builder->where('tbl_solicitud_rol.sr_estado', 1);      
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
        $builder = $db->table('tbl_solicitud_rol');
        $builder->set($data);
		$builder->insert();

    }
    public function actualizar($ipm_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_inmueble_pago_mensual');
        $builder->where('tbl_inmueble_pago_mensual.ipm_id', $ipm_id);
		return $builder->update($data);        
    }
    public function eliminar($sr_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_solicitud_rol');
        $builder->where('tbl_solicitud_rol.sr_id', $sr_id);   
		$builder->update($data);        
    }

}