<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $productModel = new Application_Model_Product();
        $this->view->producten = $productModel->getAll();
        $id_gebruiker = $this->getGebruikerId();
        $this->getWinkelmand($id_gebruiker);
    }

    public function detailAction()
    {
        $id = $this->_getParam('id');
        
        $productModel = new Application_Model_Product();
        $winkelmandModel = new Application_Model_Winkelmand();
        $product = $productModel->find($id)->current();
        $this->view->product = $product;
        
        $fields = array(
            'session' => session_id(),
            'id_product' => $id,
        );
        $winkelmand = $winkelmandModel->getOneByFields($fields);
        
        $winkelmandForm = new Application_Form_Winkelmand();
        $values = array(
            'aantal' => $winkelmand['aantal'],
            'ID_Product' => $product['id'],
        );
        $winkelmandForm->populate($values);
        $this->view->winkelmandForm = $winkelmandForm;
        
        if ($this->getRequest()->isPost()){
            $postParams= $this->getRequest()->getPost();
            //Zend_Debug::dump($postParams);exit;
            $data = array(
                'product_id' => $postParams['ID_Product'],
                'Aantal' => $postParams['aantal'],
            );
            $this->toevoegenAanWinkelmand($data);
        }
    }
    
    public function mandAction()
    {
        $product_id = $this->_getParam('id');
        
        $data = array('product_id' => $product_id);
        $this->toevoegenAanWinkelmand($data);
        
    }
    
    public function toevoegenAanWinkelmand($data) {
        $productModel = new Application_Model_Product();
        $winkelmandModel = new Application_Model_Winkelmand();
                
        $product = $productModel->getOne($data['product_id']);
        $aantal = isset($data['Aantal']) ? $data['Aantal'] : 1;

        $id_gebruiker = $this->getGebruikerId();
        
        if($id_gebruiker) {
            //check winkelmand met id_gebruiker
            $winkelmand = $winkelmandModel->getOneByField('id_gebruiker', $id_gebruiker);
        } else {
            //check winkelmand met sessionId
            $fields = array(
                'session' => session_id(),
                'id_gebruiker' => null,
            );
            $winkelmand = $winkelmandModel->getOneByFields($fields);
        }
        
        if($winkelmand) {
            $aantal = $winkelmand['aantal'] + $aantal;
            $params = array(
                'aantal' => $aantal,
            );
            $winkelmandModel->wijzigen($params, $winkelmand['id']);
        } else {
            $params = array(
                'id_product' => $data['product_id'],
                'id_gebruiker' => $id_gebruiker,
                'session' => session_id(),
                'aantal' => $aantal,
                'naam' => $product['naam'],
                'prijs' => $product['prijs'],
            );
            //Zend_Debug::dump($params);
            $winkelmandModel->toevoegen($params);
        }
        
        $this->getWinkelmand($id_gebruiker);
    }
    
    public function getWinkelmand($id_gebruiker) {
        $winkelmandModel = new Application_Model_Winkelmand();
        if($id_gebruiker) {
            $where = 'id_gebruiker='.$id_gebruiker;
        } else {
            $where = 'session="'.session_id().'" and id_gebruiker is null';
        }
        $this->view->winkelmanden = $winkelmandModel->getAll($where);
    }
    
    public function getGebruikerId() {
        $gebruikerModel = new Application_Model_Gebruiker();
        $id_gebruiker = null;
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()) {
            $username = $auth->getIdentity();
            $gebruiker = $gebruikerModel->getOneByField('naam', $username);
            $id_gebruiker = $gebruiker ? $gebruiker['id'] : null;
        } 
        return $id_gebruiker;
    }
}
