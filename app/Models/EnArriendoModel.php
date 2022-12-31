<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class EnArriendoModel extends Model
{
    public function getEnArriendoArrendatario($ea_id_persona_arrendatario)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_en_arriendo');
        $builder->select('tbl_en_arriendo.*,tbl_inmueble.*,tbl_persona.*'); 
        $builder->join('tbl_inmueble', 'tbl_en_arriendo.ea_id_inmueble=tbl_inmueble.in_id');
        $builder->join('tbl_persona', 'tbl_en_arriendo.ea_id_persona_solicitante=tbl_persona.per_id');  
        $builder->where('tbl_en_arriendo.ea_id_persona_arrendatario', $ea_id_persona_arrendatario);   
        $builder->where('tbl_en_arriendo.ea_estado', 1);       
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
        $builder = $db->table('tbl_en_arriendo');
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
    public function eliminar($ea_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_en_arriendo');
        $builder->where('tbl_en_arriendo.ea_id', $ea_id);   
		$builder->update($data);        
    }

}