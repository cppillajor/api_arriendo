<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class GaleriaModel extends Model
{
    public function getgaleriasegunidinmueble($gal_id_inmueble)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_galeria');
        $builder->select('tbl_galeria.*');         
        $builder->where('tbl_galeria.gal_id_inmueble', $gal_id_inmueble);   
        $builder->where('tbl_galeria.gal_estado', 1);       
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
        $builder = $db->table('tbl_galeria');
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
    public function eliminar($gal_id,$data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_galeria');
        $builder->where('tbl_galeria.gal_id', $gal_id);   
		$builder->update($data);        
    }

}