<?php
/**
 * @file
 * Contains \Drupal\mailjet_campaign\Controller\MailjetController.
 */

namespace Drupal\mailjet_campaign\Controller;

use Drupal\mailjet_event\Event\BlockedEvent;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MailjetTools\MailjetApi;

class CampaignAdminController extends ControllerBase {

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
    $mailjetIframe->setInitialPage(\MailjetIframe\MailjetIframe::PAGE_CAMPAIGNS);
    $callbackurl = urlencode($base_url . '?q=/admin/mailjet/campaign/alter_callback');
    $mailjetIframe->setCallback($callbackurl);

    $build = [
      '#type' => 'inline_template',
      '#template' => '<div id="iframe-main-container" class="iframe-main-container" style="width:100%; height: 1300px;">' . $mailjetIframe->getHtml() . '</div>',
    ];

    return $build;
  }

}