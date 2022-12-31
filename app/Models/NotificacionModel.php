<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class NotificacionModel extends Model
{
    public function getNotificacionsegunidpersona($no_id_persona_solicitante)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_notificacion');
        $builder->select('tbl_notificacion.*,tbl_inmueble.*');  
        $builder->join('tbl_inmueble', 'tbl_notificacion.no_id_inmueble=tbl_inmueble.in_id');
        $builder->where('tbl_notificacion.no_id_persona_solicitante', $no_id_persona_solicitante); 
        $builder->where('tbl_notificacion.no_estado', 1);        
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function getAjusteCentavo($ajc_id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_ajuste_centavos');
        $builder->select('tbl_ajuste_centavos.*');    
        $builder->where('tbl_ajuste_centavos.ajc_id', $ajc_id);        
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function insertar($data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_notificacion');
        $builder->set($data);
		$builder->insert();

    }
    public function actualizar($ajc_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_ajuste_centavos');
        $builder->where('tbl_ajuste_centavos.ajc_id', $ajc_id);
		return $builder->update($data);        
    }
    public function eliminar($no_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_notificacion');
        $builder->where('tbl_notificacion.no_id', $no_id);   
		$builder->update($data);        
    }

}