<?php

class GebruikerController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $form = new Application_Form_Signup();
        $postParams = $this->getRequest()->getPost();
        //Zend_Debug::dump($postParams);exit;
        if($this->getRequest()->getPost()) {
            if($form->isValid($postParams)) {
                $auth = Zend_Auth::getInstance();
                //meegeven welke database driver we gebruiken, is optioneel omdat we er momenteel maar 1 hebben
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Registry::get('db'));
                $authAdapter->setTableName('gebruikers')
                            ->setIdentityColumn('naam')
                            ->setCredentialColumn('wachtwoord')
                            ->setIdentity($postParams['naam'])
                            ->setCredential($postParams['wachtwoord']);
                //login uitvoeren
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()) {
                    $this->_redirect($this->view->url(array('controller'=> 'index', 'action'=> 'index')));
                    //echo 'U bent ingelogd!';
                } else {
                    //alle foutmeldingen weergeven op het scherm
                    foreach($result->getMessages() as $message) {
                        echo $message;
                    }
                }
            }
        }

    }
    
    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect($this->view->url(array('controller'=> 'index', 'action'=> 'index')));
    }

}

