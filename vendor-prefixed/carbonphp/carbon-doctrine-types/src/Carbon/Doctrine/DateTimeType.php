<?php

declare (strict_types=1);
namespace CbxTaxonomyScoped\Carbon\Doctrine;

use CbxTaxonomyScoped\Carbon\Carbon;
use DateTime;
use CbxTaxonomyScoped\Doctrine\DBAL\Platforms\AbstractPlatform;
use CbxTaxonomyScoped\Doctrine\DBAL\Types\VarDateTimeType;
class DateTimeType extends VarDateTimeType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<Carbon> */
    use CarbonTypeConverter;
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Carbon
    {
        return $this->doConvertToPHPValue($value);
    }
}
