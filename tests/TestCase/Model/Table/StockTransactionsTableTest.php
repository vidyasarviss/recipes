<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockTransactionsTable Test Case
 */
class StockTransactionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StockTransactionsTable
     */
    public $StockTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stock_transactions',
        'app.items',
        'app.units',
        'app.warehouses',
        'app.references'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StockTransactions') ? [] : ['className' => StockTransactionsTable::class];
        $this->StockTransactions = TableRegistry::getTableLocator()->get('StockTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StockTransactions);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
