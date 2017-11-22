<?php

namespace Drupal\mailjet_event\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Event that is fired when cron maintenance tasks are performed.
 *
 * @see rules_cron()
 */
class UnsubscribeEvent extends GenericEvent {

  const EVENT_NAME = 'unsubscribe_event';

}
