<?php

namespace Drupal\Tests\mailjet\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;

/**
 * Simple test to ensure that main page loads with module enabled.
 * @group mailjet
 */
class MailjetDomainFormTest extends BrowserTestBase
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
        $this->drupalGet('admin/config/system/mailjet/domains/add-domain');
        $this->assertSession()->statusCodeEquals(200);

        $this->assertSession()->fieldExists('domain');
        $this->assertSession()->fieldValueEquals('domain', 'example.com');


        $this->submitForm(
            [
                'domain' => 'example.com',
            ],
            t('Save configuration')
        );
        $this->assertSession()->responseContains('The configuration options have been saved.');
    }

}

