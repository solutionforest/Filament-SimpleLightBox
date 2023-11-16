<?php

namespace SolutionForest\FilamentSimpleLightBox\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SolutionForest\FilamentSimpleLightBox\FilamentSimpleLightBox
 */
class FilamentSimpleLightBox extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \SolutionForest\FilamentSimpleLightBox\FilamentSimpleLightBox::class;
    }
}
