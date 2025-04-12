<?php

namespace Tests;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::now());
    }
}
