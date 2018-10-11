<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProprietesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProprietesTable Test Case
 */
class ProprietesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProprietesTable
     */
    public $Proprietes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.proprietes',
        'app.vendeurs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Proprietes') ? [] : ['className' => ProprietesTable::class];
        $this->Proprietes = TableRegistry::getTableLocator()->get('Proprietes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Proprietes);

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
