<?php

namespace CbxTaxonomyScoped\Illuminate\Database\PDO;

use CbxTaxonomyScoped\Doctrine\DBAL\Driver\AbstractSQLiteDriver;
use CbxTaxonomyScoped\Illuminate\Database\PDO\Concerns\ConnectsToDatabase;
class SQLiteDriver extends AbstractSQLiteDriver
{
    use ConnectsToDatabase;
}
