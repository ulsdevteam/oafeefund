<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CronChecksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CronChecksTable Test Case
 */
class CronChecksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CronChecksTable
     */
    public $CronChecks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cron_checks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CronChecks') ? [] : ['className' => CronChecksTable::class];
        $this->CronChecks = TableRegistry::get('CronChecks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CronChecks);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
