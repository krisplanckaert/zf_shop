<?php
class Application_Model_Role extends Zend_Db_Table_Abstract
{
    //definieren hoe de tabel eruit ziet    
    protected $_name = 'roles';
    protected $_primary = 'id';
    
    
    public function getAll()
    {
        return $this->fetchAll(); // select * from nieuws                        
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
    
    public function getRolesList() {
        $return = array();
        $roles = $this->getAll()->toArray();
        foreach($roles as $role) {
            $return[$role['id']] = $role['role'];
        }
        //Zend_Debug::dump($return);
        return $return;
    }
    
}
?>
