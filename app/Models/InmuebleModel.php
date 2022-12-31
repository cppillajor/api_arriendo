<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class InmuebleModel extends Model
{
    public function getseguntipoinmueble($in_id_tipo_inmueble)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_inmueble');
        $builder->select('tbl_inmueble.*,tbl_tipo_inmueble.*');   
        $builder->join('tbl_tipo_inmueble', 'tbl_inmueble.in_id_tipo_inmueble=tbl_tipo_inmueble.tin_id');  
        $builder->where('tbl_inmueble.in_id_tipo_inmueble', $in_id_tipo_inmueble);
        $builder->where('tbl_inmueble.in_estado', 1);       
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function getsegunidpersona($in_id_persona)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_inmueble');
        $builder->select('tbl_inmueble.*');     
        $builder->where('tbl_inmueble.in_id_persona', $in_id_persona);
        $builder->where('tbl_inmueble.in_estado', 1);       
        $query=$builder->get();
        $resultado=$query->getResultArray();
        return $resultado;
    }
    public function getUnInmueble($in_id)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_inmueble');
        $builder->select('tbl_inmueble.*,tbl_persona.*');   
        $builder->join('tbl_persona', 'tbl_inmueble.in_id_persona = tbl_persona.per_id');  
        $builder->where('tbl_inmueble.in_id', $in_id);
        $builder->where('tbl_inmueble.in_estado', 1);       
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
        $builder = $db->table('tbl_inmueble');
        $builder->set($data);
		$builder->insert();

    }
    public function actualizar($in_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_inmueble');
        $builder->where('tbl_inmueble.in_id', $in_id);
		return $builder->update($data);        
    }
    public function eliminar($in_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_inmueble');
        $builder->where('tbl_inmueble.in_id', $in_id);   
		$builder->update($data);        
    }

}