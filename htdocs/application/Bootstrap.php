<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initMyActionHelpers()
    {
        $this->bootstrap('frontController');
        $signup = Zend_Controller_Action_HelperBroker::getStaticHelper('Signup');
        Zend_Controller_Action_HelperBroker::addHelper($signup);
    }

    protected function _initRegisterControllerPlugins() 
    {
        //$this->bootstrap('frontController');        
        $front = $this->getResource('frontcontroller');
        $front->registerPlugin(new Syntra_Controller_Plugin_Translate());        
        $front->registerPlugin(new Syntra_Controller_Plugin_Navigation());
        $front->registerPlugin(new Syntra_Auth_Acl());
        $front->registerPlugin(new Syntra_Auth_Auth());
    }    
    
    public function _initDbAdapter() 
    {
        $this->bootstrap('db');    
        $db = $this->getResource('db');
        
        Zend_Registry::set('db',$db);
        //Ophalen dmv Zend_Registry::get('db');
    }
    
    public function _initRouter(array $options=NULL)
    {    
        $router = $this->getResource('frontcontroller')->getRouter();
        //add custom route
        // : before param = get variabele
        $router->addRoute('noaccess', 
            new Zend_Controller_Router_Route('noaccess', array(
                'controller' => 'noaccess',
                'action'     => 'index',
            )));   
        
        //add custom route
        // : before param = get variabele
        $router->addRoute('logout', 
            new Zend_Controller_Router_Route('/logout', array(
                'controller' => 'gebruiker',
                'action'     => 'logout',
            )));
    }
}

