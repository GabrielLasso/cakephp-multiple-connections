<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestTable Test Case
 */
class TestTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TestTable
     */
    public $Test;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.test'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Test') ? [] : ['className' => TestTable::class];
        $this->Test = TableRegistry::getTableLocator()->get('Test', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Test);

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
