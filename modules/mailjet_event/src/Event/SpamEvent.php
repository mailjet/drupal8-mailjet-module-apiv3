<?php

namespace Drupal\mailjet_event\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Event that is fired when cron maintenance tasks are performed.
 *
 * @see rules_cron()
 */
class SpamEvent extends GenericEvent {

  const EVENT_NAME = 'spam_event';

}
