<?php

namespace CbxTaxonomyScoped\Illuminate\Support;

use CbxTaxonomyScoped\Carbon\Carbon as BaseCarbon;
use CbxTaxonomyScoped\Carbon\CarbonImmutable as BaseCarbonImmutable;
class Carbon extends BaseCarbon
{
    /**
     * {@inheritdoc}
     */
    public static function setTestNow($testNow = null)
    {
        BaseCarbon::setTestNow($testNow);
        BaseCarbonImmutable::setTestNow($testNow);
    }
}
