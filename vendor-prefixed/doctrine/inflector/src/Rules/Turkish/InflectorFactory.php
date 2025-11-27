<?php

declare (strict_types=1);
namespace CbxTaxonomyScoped\Doctrine\Inflector\Rules\Turkish;

use CbxTaxonomyScoped\Doctrine\Inflector\GenericLanguageInflectorFactory;
use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Ruleset;
final class InflectorFactory extends GenericLanguageInflectorFactory
{
    protected function getSingularRuleset(): Ruleset
    {
        return Rules::getSingularRuleset();
    }
    protected function getPluralRuleset(): Ruleset
    {
        return Rules::getPluralRuleset();
    }
}
