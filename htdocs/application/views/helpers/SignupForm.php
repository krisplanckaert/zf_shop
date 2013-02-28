<?php



class Zend_View_Helper_SignupForm extends Zend_View_Helper_Abstract

{

    public function signupForm(Application_Form_Signup $form)

    {
        $html = '<p>Hier kan je inloggen</p>';
        if($form->processed) {

            $html .= '<p>Bedankt om in te loggen</p>';

        } else {

            $html .= $form->render();

        }

        return $html;

    }

}