<?php
/**
 * @file
 * Contains \Drupal\mailjet_campaign\Controller\MailjetController.
 */

namespace Drupal\mailjet_campaign\Controller;

use Drupal\mailjet_event\Event\BlockedEvent;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CampaignAdminController extends ControllerBase {

  public function content() {

    $build = [];

    $build = [
      '#type' => 'inline_template',
      '#template' => '<iframe src="{{ url }}" width="100%" height="1080px" frameborder="0"></iframe>',
      '#context' => [
        'url' => mailjet_campaign_iframe(),
      ],
    ];
    return $build;

  }
}