<?php
 
/**
 *  * @file
 *  * Contains \Drupal\mailjet\Form\MailjetSettingsForm.
 *   */

namespace Drupal\mailjet\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use MailJet\MailJet;

class MailjetApiForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'mailjet_api.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mailjet_api_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config_mailjet = $this->config('mailjet.settings');
    $form = parent::buildForm($form, $form_state);
    $form['api'] = [
      '#type' => 'fieldset',
    ];

    $form['api']['welcome'] = [
      '#markup' => t('Welcome to the Mailjet Configuration page.</br>
      If you are new to Mailjet, please register by clicking on the button above.</br>
      Should you already have a pre-existing Mailjet account, please copy and paste your Mailjet API Key and Secret Key which can be found '),
    ];

    $form['api']['mailjet_username'] = [
      '#type' => 'textfield',
      '#title' => t('API Key'),
      '#default_value' => $config_mailjet->get('mailjet_username'),
      '#required' => TRUE,
    ];

    $form['api']['mailjet_password'] = [
      '#type' => 'textfield',
      '#title' => t('Secret Key'),
      '#default_value' => $config_mailjet->get('mailjet_password'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = \Drupal::service('config.factory')
      ->getEditable('mailjet.settings');


    $config->set('mailjet_username', $form_state->getValue('mailjet_username'));
    $config->set('mailjet_password', $form_state->getValue('mailjet_password'));
    $config->save();

    $mailjet = new MailJet($form_state->getValue('mailjet_username'), $form_state->getValue('mailjet_password'));


    $paramsProfile = [
      'method' => 'GET',
    ];

    $response = $mailjet->myprofile($paramsProfile)->getResponse();

    if ($response) {

      $config->set('mailjet_active', TRUE);

      $params = [
        'AllowedAccess' => 'campaigns,contacts,stats,pricing,account,reports',
        'method' => 'JSON',
        'APIKeyALT' => $mailjet->getAPIKey(),
        'TokenType' => 'iframe',
        'IsActive' => TRUE,
      ];
      $mailjet->resetRequest();
      $response2 = $mailjet->apitoken($params)->getResponse();

      if ($response2->Count > 0) {

        $config->set('APItoken', $response2->Data[0]->Token);
        $config->save();
        mailjet_first_sync(mailjet_get_default_list_id(mailjet_new()));

        drupal_set_message(t('The configuration options have been saved.'));
        drupal_flush_all_caches();
      }
      else {
        $form_state->setErrorByName('mailjet_username', t('Token was NOT generated! Please try again.'));
      }
    }
    else {
      drupal_set_message(t('Please verify that you have entered your API and secret key correctly. Please note this plug-in is compatible for Mailjet v3 accounts only. Click <a href=" https://app.mailjet.com/support/why-do-i-get-an-api-error-when-trying-to-activate-a-mailjet-plug-in,497.htm"> here</a> for more information'), 'error');
    }

  }

}
