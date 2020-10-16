<?php

namespace Appino\Blockchain\Tests;

use Orchestra\Testbench\TestCase;
use Appino\Blockchain\BlockchainServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BlockchainServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
