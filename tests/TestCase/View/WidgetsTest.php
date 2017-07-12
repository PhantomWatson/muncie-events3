<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WidgetsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Facebook\FacebookRedirectLoginHelper;

/**
 * App\Controller\UsersController Test Case
 */
class WidgetsViewTest extends IntegrationTestCase
{
    /**
     * Test widgets index
     *
     * @return void
     */
    public function testWidgetsIndex()
    {
        $helper = new FacebookRedirectLoginHelper(
            'PLACEHOLDER',
            'PLACEHOLDER',
            'PLACEHOLDER'
        );
        $helper->disableSessionStatusCheck();

        $this->get('/widgets');
        $this->assertResponseOk();
        $this->assertResponseContains('Website Widgets</h1>');
        $this->assertResponseContains('<iframe class="widgets"');
    }

    /**
     * Test feed & month customizers
     *
     * @return void
     */
    public function testCustomizer()
    {
        $helper = new FacebookRedirectLoginHelper(
            'PLACEHOLDER',
            'PLACEHOLDER',
            'PLACEHOLDER'
        );
        $helper->disableSessionStatusCheck();

        $customizer = '<div class="widget_demo col-lg-7" id="widget_demo"></div>';

        $this->get('/widgets/customize/feed');
        $this->assertResponseOk();
        $this->assertResponseContains($customizer);

        $this->get('/widgets/customize/month');
        $this->assertResponseOk();
        $this->assertResponseContains($customizer);
    }

    /**
     * Test feed widget view
     *
     * @return void
     */
    public function testFeedWidget()
    {
        $helper = new FacebookRedirectLoginHelper(
            'PLACEHOLDER',
            'PLACEHOLDER',
            'PLACEHOLDER'
        );
        $helper->disableSessionStatusCheck();

        $this->Events = TableRegistry::get('Events');

        $this->get('/widgets/feed');
        $this->assertResponseOk();

        $testEvent = $this->Events->find()
            ->where(['date >' => date("Y-m-d")])
            ->first();

        $this->assertResponseContains("$testEvent->title");
    }

    /**
     * Test month widget view
     *
     * @return void
     */
    public function testMonthWidget()
    {
        $helper = new FacebookRedirectLoginHelper(
            'PLACEHOLDER',
            'PLACEHOLDER',
            'PLACEHOLDER'
        );
        $helper->disableSessionStatusCheck();

        $this->Events = TableRegistry::get('Events');

        $this->get('/widgets/month');
        $this->assertResponseOk();

        $testEvent = $this->Events->find()
            ->where(['date >' => date("Y-m-d")])
            ->first();

        $this->assertResponseContains("$testEvent->title");
    }
}
