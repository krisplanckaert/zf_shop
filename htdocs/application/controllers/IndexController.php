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
        
        $params = array(
            'id_product' => $data['product_id'],
            'id_gebruiker' => null,
            'session' => session_id(),
            'aantal' => $aantal,
            'naam' => $product['naam'],
            'prijs' => $product['prijs'],
        );
        //Zend_Debug::dump($params);
        $winkelmandModel->toevoegen($params);
        
        $where = 'session="'.session_id().'"';
        $this->view->winkelmanden = $winkelmandModel->getAll($where);
    }
}

