<?php
/**
 * @file
 * Contains \Drupal\mailjet_campaign\Controller\CampaignCallback .
 */

namespace Drupal\mailjet_campaign\Controller;

use Drupal\Core\Controller\ControllerBase;

class CampaignCallback extends ControllerBase {

  public function callback() {

    _mailjet_campaign_alter_callback();

  }
}