<?php

declare (strict_types=1);
namespace CbxTaxonomyScoped\Doctrine\Inflector\Rules\NorwegianBokmal;

use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Pattern;
use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Substitution;
use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Transformation;
use CbxTaxonomyScoped\Doctrine\Inflector\Rules\Word;
class Inflectible
{
    /** @return Transformation[] */
    public static function getSingular(): iterable
    {
        yield new Transformation(new Pattern('/re$/i'), 'r');
        yield new Transformation(new Pattern('/er$/i'), '');
    }
    /** @return Transformation[] */
    public static function getPlural(): iterable
    {
        yield new Transformation(new Pattern('/e$/i'), 'er');
        yield new Transformation(new Pattern('/r$/i'), 're');
        yield new Transformation(new Pattern('/$/'), 'er');
    }
    /** @return Substitution[] */
    public static function getIrregular(): iterable
    {
        yield new Substitution(new Word('konto'), new Word('konti'));
    }
}
