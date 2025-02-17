<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ValidatorHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ValidatorHelper Test Case
 */
class ValidatorHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ValidatorHelper
     */
    protected $Validator;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Validator = new ValidatorHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Validator);

        parent::tearDown();
    }
}
