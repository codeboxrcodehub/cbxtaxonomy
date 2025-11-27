<?php

declare (strict_types=1);
namespace CbxTaxonomyScoped\Carbon\Doctrine;

use CbxTaxonomyScoped\Carbon\CarbonImmutable;
use DateTimeImmutable;
use CbxTaxonomyScoped\Doctrine\DBAL\Platforms\AbstractPlatform;
use CbxTaxonomyScoped\Doctrine\DBAL\Types\VarDateTimeImmutableType;
class DateTimeImmutableType extends VarDateTimeImmutableType implements CarbonDoctrineType
{
    /** @use CarbonTypeConverter<CarbonImmutable> */
    use CarbonTypeConverter;
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?CarbonImmutable
    {
        return $this->doConvertToPHPValue($value);
    }
    /**
     * @return class-string<CarbonImmutable>
     */
    protected function getCarbonClassName(): string
    {
        return CarbonImmutable::class;
    }
}
