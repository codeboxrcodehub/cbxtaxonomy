<?php

namespace CbxTaxonomyScoped\Illuminate\Contracts\Container;

use Exception;
use CbxTaxonomyScoped\Psr\Container\ContainerExceptionInterface;
class CircularDependencyException extends Exception implements ContainerExceptionInterface
{
    //
}
