<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->loginForm = new Application_Form_Login();
        
        $productModel = new Application_Model_Product();
        $this->view->product = $productModel->fetchAll();
    }


}

