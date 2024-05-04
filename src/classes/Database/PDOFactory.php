<?php

namespace CT275\Labs\Database;

use PDO;

class PDOFactory
{
    /**
     * Create a new PDO instance.
     *
     * @return PDO
     */
    public function create(): PDO
    {
        $dsn = $this->buildDsn();
        $options = $this->getDefaultOptions();

        return new PDO($dsn, DBConfig::DB_USER, DBConfig::DB_PASS, $options);
    }

    /**
     * Build the DSN (Data Source Name) for PDO connection.
     *
     * @return string
     */
    private function buildDsn(): string
    {
        return sprintf(
            'mysql:host=%s;dbname=%s;charset=utf8mb4',
            DBConfig::DB_HOST,
            DBConfig::DB_NAME
        );
    }

    /**
     * Get the default PDO options.
     *
     * @return array
     */
    private function getDefaultOptions(): array
    {
        return [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    }
}
