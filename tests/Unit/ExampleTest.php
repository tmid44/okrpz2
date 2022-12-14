<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_mainpage()
    {     $response = $this->get('/posts');
        $this->assertEquals(302, $response->status());
    }
    public function test_that_true_is_true()
    {

        $this->assertTrue(true);

    }
}
