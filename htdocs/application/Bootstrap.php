<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initMyActionHelpers()
    {
        $this->bootstrap('frontController');
        $signup = Zend_Controller_Action_HelperBroker::getStaticHelper('Signup');
        Zend_Controller_Action_HelperBroker::addHelper($signup);
    }
    
    public function _initNavigation() {
        // registreer de navigation plugin
        $this->bootstrap('frontController');
        $front = $this->getResource('frontController');
        $front->registerPlugin(new Syntra_Controller_Plugin_Navigation());
    }
}

