<?php
/**
 * @file
 * Contains \Drupal\mailjet_stats\Controller\StatsAdminController.
 */

namespace Drupal\mailjet_stats\Controller;

use Drupal\Core\Controller\ControllerBase;

class StatsAdminController extends ControllerBase {

  public function content() {
    $build = [];

    $build = [
      '#type' => 'inline_template',
      '#template' => '<iframe src="{{ url }}" width="100%" height="1080px" frameborder="0"></iframe>',
      '#context' => [
        'url' => mailjet_stats_iframe(),
      ],
    ];
    return $build;
  }
}