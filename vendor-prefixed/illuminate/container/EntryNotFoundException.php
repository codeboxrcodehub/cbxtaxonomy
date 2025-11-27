<?php

namespace CbxTaxonomyScoped\Illuminate\Container;

use Exception;
use CbxTaxonomyScoped\Psr\Container\NotFoundExceptionInterface;
class EntryNotFoundException extends Exception implements NotFoundExceptionInterface
{
    //
}
