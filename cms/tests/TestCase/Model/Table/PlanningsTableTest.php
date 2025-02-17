<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanningsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanningsTable Test Case
 */
class PlanningsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanningsTable
     */
    protected $Plannings;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Plannings',
        'app.Lessons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Plannings') ? [] : ['className' => PlanningsTable::class];
        $this->Plannings = $this->getTableLocator()->get('Plannings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Plannings);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlanningsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
