<?php

class ProductController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */        
        
    }

    public function indexAction()
    {
        // action body
        $productModel = new Application_Model_Product();
        $this->view->producten= $productModel->getAll()->toArray();
    }
    
    public function wijzigenAction()
    {
        // action body
    }

    public function toevoegenAction()
    {
        // action body
    }

    public function verwijderenAction()
    {
        // action body
    }


}







