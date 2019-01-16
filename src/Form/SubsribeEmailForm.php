<?php
/**
 *  * @file
 *  * Contains \Drupal\mailjet\Form\SubsribeEmailForm.
 *  */

namespace Drupal\mailjet\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use MailjetTools\MailjetApi;
use Mailjet\Client;
use Mailjet\Resources;

class SubsribeEmailForm extends ConfigFormBase {

  public function getFormId() {

    return 'subscribe_admin_form';

  }

  protected function getEditableConfigNames() {

    return ['config.subscribe_form'];

  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = [];
    if (isset($_GET['list']) && !empty($_GET['list'])) {
      $list_id = $_GET['list'];
    }
    if (isset($_GET['sec_code']) && !empty($_GET['sec_code'])) {
      $sec_code_email = base64_decode($_GET['sec_code']);
    }
    if (isset($_GET['properties']) && !empty($_GET['properties'])) {
      $properties = json_decode(base64_decode($_GET['properties']));
    }
    if (isset($_GET['others']) && !empty($_GET['others'])) {
      $form_hidden_id = $_GET['others'];
    }
    else {
      return FALSE;
    }
    $signup_form = mailjet_subscription_load($form_hidden_id);
    $mailjetApiClient = mailjet_new();

    $contact = [
      'Email' => $sec_code_email
    ];

    // If we have any properties we clean the `signup-` part from the name and prepare them to sync to Mailjet
    // Note that the `$properties` is Object not Array
    if (isset($properties) && !empty($properties)) {
        $propertiesClean = [];
        foreach ($properties as $key => $value) {
            if (stristr($key, 'signup-')) {
                $keyClean = str_ireplace('signup-', '', $key);
                $propertiesClean[$keyClean] = $value;
            }
        }
        $contact['Properties'] = $propertiesClean;
    }

    //add new email
    $response = MailjetApi::syncMailjetContact($list_id, $contact);
    if (false != $response) {
      if (!empty($signup_form->success_message_subsribe)) {
        drupal_set_message(t($signup_form->success_message_subsribe), 'status');
      } else {
        drupal_set_message(t('You have successfully subscribed to Mailjet contact list! Thank you!'));
      }
    }

    return $form;
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

  }

}
