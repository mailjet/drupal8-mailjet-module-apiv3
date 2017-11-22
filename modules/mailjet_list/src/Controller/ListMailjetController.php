<?php
/**
 * @file
 * Contains \Drupal\mailjet_list\Controller\ListMailjetController.
 */

namespace Drupal\mailjet_list\Controller;

use Drupal\Core\Controller\ControllerBase;

class ListMailjetController extends ControllerBase {

  public function content() {
    $build = [];

    $build = [
      '#type' => 'inline_template',
      '#template' => '<iframe src="{{ url }}" width="100%" height="1080px" frameborder="0"></iframe>',
      '#context' => [
        'url' => mailjet_list_iframe(),
      ],
    ];
    return $build;

  }
}