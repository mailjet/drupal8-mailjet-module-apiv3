<?php
/**
 * @file
 * Contains \Drupal\mailjet_event\Controller\EventUninstallController.
 */

namespace Drupal\mailjet_event\Controller;

use Drupal\Core\Controller\ControllerBase;

class EventUninstallController extends ControllerBase {

  public function callback() {
    $build = [];

    $controller = \Drupal::entityTypeManager()->getStorage('event_entity');
    $entities = $controller->loadMultiple();
    $controller->delete($entities);

    \Drupal::messenger()->addMessage(t('Event entities is removing succcefully!'), "status", FALSE);

    return $build;

  }
}