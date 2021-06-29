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
        $form['text'] = array(
            '#type' => 'textarea',
            '#title' => t('About your message'),
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

        $mailManager = \Drupal::service('plugin.manager.mail');
        $module = 'custompar';
        $key = 'important_event';
        $to = \Drupal::currentUser()->getEmail();
        $params['message'] = 'Hello! This is a test message from my site!';
        $params['updated_nodes'] = 10;
        $langcode = \Drupal::currentUser()->getPreferredLangcode();
        $send = true;

//Try to send letter:
        $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

        if ($result['result'] !== true) {
            //Email has not been sent.
        }
        else {
            //Email sent successfully.
        }

    }
}