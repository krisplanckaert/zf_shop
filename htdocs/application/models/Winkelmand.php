<?php
//class Application_Model_Winkelmand extends Zend_Db_Table_Abstract
class Application_Model_Winkelmand extends My_Model
{
    //private $db; 
    
    protected $_name = 'winkelmanden';
    protected $_primary = 'id';
    
    public function init()
    {
    	$this->db = $this->getAdapter();
    }    
    
    public function getAll($where=null,$order=null)
    {
   	$data = $this->fetchAll($where,$order);
        return $data->toArray();
    }    
    
    public function toevoegen($params) 
    {
        $this->insert($params);        
        
    }
    
    public function wijzigen($params, $id)
    {
         $where  = $this->getAdapter()->quoteInto('id= ?', $id);
         $this->update($params, $where);   
    }       
        
    public function verwijder($id)
    {
         $where  = $this->getAdapter()->quoteInto('id= ?', $id);
         $this->delete($where);   
    }    
        
    public function getOne($id,$colName = 'ID')
    {
    	$where  = '';
    	$where .= $colName . ' = ' .(int)$id;
        $row = parent::fetchRow($where);            
        if (!$row) {
            return FALSE; 
        }
        $this->data = $row->toArray();
        return $this->data;
    }
    
    public function getOneByFields(array $fields,$operator = 'AND'){
    	$where = '0 = 0'; 
    	foreach($fields as $k=>$v){
    		$where .= ' '. $operator . ' ' . $k . '=' . $this->db->quote($v);
    	}
        //die($where);
    	$row = parent::fetchRow($where);            
        if (!$row) {
            return FALSE; 
        }
        return $row->toArray();    	
    }  
}
?>
