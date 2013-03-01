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
        
        //Zend_Debug::dump($this->view->producten);exit;
    }

    public function detailAction()
    {
        $id = $this->_getParam('id');
        
        $productModel = new Application_Model_Product();
        $this->view->product = $productModel->find($id)->current();
        
    }
    
    public function mandAction()
    {
        
    }

}

