<?php

class Application_Model_Menurole extends My_Model
{

    protected $_name = 'menuroles';
    protected $_primary = 'id';

    public function getMenuByRole($roleId, $locale) {
        $select = $this->db->select();
        $select->from(array('mr' => $this->getTableName()));
        $select->join(array('m' => 'menu'), 'm.id = mr.id_menu', array('label' => 'm.label', 'action' => 'm.action', 'controller' => 'm.controller', 'module' => 'm.module', 'slug' => 'm.slug'));
        $select->where('mr.id_role = ?', (int)$roleId );
        $select->where('m.locale = ?', $locale );
        return $this->db->fetchAll($select);
    }
}

