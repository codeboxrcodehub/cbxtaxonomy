<?php

namespace CbxTaxonomyScoped\Illuminate\Database\PDO;

use CbxTaxonomyScoped\Doctrine\DBAL\Driver\AbstractMySQLDriver;
use CbxTaxonomyScoped\Illuminate\Database\PDO\Concerns\ConnectsToDatabase;
class MySqlDriver extends AbstractMySQLDriver
{
    use ConnectsToDatabase;
}
