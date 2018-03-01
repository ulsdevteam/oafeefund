<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApprovalReasonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApprovalReasonsTable Test Case
 */
class ApprovalReasonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApprovalReasonsTable
     */
    public $ApprovalReasons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.approval_reasons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ApprovalReasons') ? [] : ['className' => ApprovalReasonsTable::class];
        $this->ApprovalReasons = TableRegistry::get('ApprovalReasons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApprovalReasons);

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
