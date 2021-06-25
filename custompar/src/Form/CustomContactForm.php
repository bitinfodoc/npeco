<?php

namespace Drupal\custompar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomContactForm extends FormBase
{

    public function getFormId()
    {
        return 'custom_contact_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => t('Your name'),
            '#required' => true,
        );
        $form['phone'] = array(
            '#type' => 'tel',
            '#title' => t('Your phone'),
            '#required' => true,
        );
        $form['actions']['submit'] = array(
          '#type' => 'submit',
          '#value' =>  t('Call me!')
        );
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}