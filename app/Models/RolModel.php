<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class RolModel extends Model
{
    public function getRol()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_rol');
        $builder->select('tbl_rol.*');   
        $builder->where('tbl_rol.rol_estado', 1);  
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
        $builder = $db->table('tbl_inmueble_pago_mensual');
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
    public function eliminar($ea_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_en_arriendo');
        $builder->where('tbl_en_arriendo.ea_id', $ea_id);   
		$builder->update($data);        
    }

}