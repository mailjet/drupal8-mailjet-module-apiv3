<?php

namespace Drupal\Tests\mailjet\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;

/**
 * Simple test to ensure that main page loads with module enabled.
 * @group mailjet
 */
class MailjetApiFormTest extends BrowserTestBase
{

    /**
     * Modules to enable.
     * @var array
     */
    public static $modules = ['mailjet'];

    /**
     * A simple user with 'access content' permission
     */
    private $user;

    /**
     * Perform any initial set up tasks that run before every test method
     */
    public function setUp()
    {
        parent::setUp();
        $this->user = $this->drupalCreateUser(['access content']);
    }


    public function testApiForm()
    {
        $this->drupalLogin($this->user);
        $this->drupalGet('admin/config/system/mailjet/api');
        $this->assertSession()->statusCodeEquals(200);

        $config = $this->config('mailjet.settings');
        $this->assertSession()->fieldValueEquals('mailjet_password', $config->get('mailjet.mailjet_password'));
        $this->assertSession()->fieldValueEquals('mailjet_username', $config->get('mailjet.mailjet_username'));

        $this->submitForm([
            'mailjet_username' => $config->get('mailjet_username'),
            'mailjet_password' => $config->get('mailjet_password'),
        ],
            t('Save configuration')
        );
        $this->assertSession()->responseContains('The configuration options have been saved.');
    }

}

