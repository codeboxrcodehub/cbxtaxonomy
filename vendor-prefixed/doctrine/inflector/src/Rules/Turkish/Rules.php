<?php

declare (strict_types=1);
namespace CbxTaxonomyScoped\Doctrine\Inflector\Rules\Turkish;

use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Patterns;
use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Ruleset;
use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Substitutions;
use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Transformations;
final class Rules
{
    public static function getSingularRuleset(): Ruleset
    {
        return new Ruleset(new Transformations(...Inflectible::getSingular()), new Patterns(...Uninflected::getSingular()), (new Substitutions(...Inflectible::getIrregular()))->getFlippedSubstitutions());
    }
    public static function getPluralRuleset(): Ruleset
    {
        return new Ruleset(new Transformations(...Inflectible::getPlural()), new Patterns(...Uninflected::getPlural()), new Substitutions(...Inflectible::getIrregular()));
    }
}
