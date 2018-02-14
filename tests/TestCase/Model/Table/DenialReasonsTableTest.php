<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DenialReasonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DenialReasonsTable Test Case
 */
class DenialReasonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DenialReasonsTable
     */
    public $DenialReasons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.denial_reasons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DenialReasons') ? [] : ['className' => DenialReasonsTable::class];
        $this->DenialReasons = TableRegistry::get('DenialReasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DenialReasons);

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
