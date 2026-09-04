<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Role::where('name', 'author')->exists()) {
            Role::create(['name' => 'author']);
            Role::create(['name' => 'admin']);
        }
    }
}