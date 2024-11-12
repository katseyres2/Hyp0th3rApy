<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessonsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessonsTable Test Case
 */
class LessonsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LessonsTable
     */
    protected $Lessons;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
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
        $config = $this->getTableLocator()->exists('Lessons') ? [] : ['className' => LessonsTable::class];
        $this->Lessons = $this->getTableLocator()->get('Lessons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Lessons);

        parent::tearDown();
    }
}
