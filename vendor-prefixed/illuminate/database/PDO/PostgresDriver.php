<?php

namespace CbxTaxonomyScoped\Illuminate\Database\PDO;

use CbxTaxonomyScoped\Doctrine\DBAL\Driver\AbstractPostgreSQLDriver;
use CbxTaxonomyScoped\Illuminate\Database\PDO\Concerns\ConnectsToDatabase;
class PostgresDriver extends AbstractPostgreSQLDriver
{
    use ConnectsToDatabase;
}
