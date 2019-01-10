<?php
/**
 * @file
 * Contains \Drupal\mailjet_list\Controller\ListMailjetController.
 */

namespace Drupal\mailjet_list\Controller;

use Drupal\Core\Controller\ControllerBase;
use MailjetTools\MailjetApi;

class ListMailjetController extends ControllerBase {

  public function content() {
    global $base_url;

    $build = [];
    $config_mailjet = \Drupal::config('mailjet.settings');
    if (empty($config_mailjet->get('mailjet_active')) && empty($config_mailjet->get('mailjet_username')) && empty($config_mailjet->get('mailjet_password'))) {
        drupal_set_message(t('You need to add your Mailjet API details before you can continue'), 'warning');
        $response = new RedirectResponse('admin/config/mailjet/settings');
        $response->send();
    }

    $mailjetIframe = MailjetApi::getMailjetIframe($config_mailjet->get('mailjet_username'), $config_mailjet->get('mailjet_password'));
    $mailjetIframe->setInitialPage(\MailjetIframe\MailjetIframe::PAGE_CONTACTS);

    $build = [
      '#type' => 'inline_template',
      '#template' => $mailjetIframe->getHtml(),
    ];

    return $build;
  }
}