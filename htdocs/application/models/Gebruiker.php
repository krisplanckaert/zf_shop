<?php

class Application_Model_Gebruiker extends My_Model
{

    protected $_name = 'gebruikers';
    protected $_primary = 'id';

    /**
     * 
     * @param Zend_Auth $identity
     * @return Zend_Db_Table_Rowset
     */
    public function getUserByIdentity($identity) 
    {
        $select = $this->select()->where('naam = ?', $identity);
        $result = $this->fetchAll($select)->current();
        
        return $result;
    }
}

