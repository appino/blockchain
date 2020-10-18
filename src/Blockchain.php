<?php

namespace Appino\Blockchain;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Appino\Blockchain\Skeleton\SkeletonClass
 */
class Blockchain extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'blockchain';
    }
}
