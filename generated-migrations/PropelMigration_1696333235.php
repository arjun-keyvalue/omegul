<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1696333235.
 * Generated on 2023-10-03 17:10:35 by arjun */
class PropelMigration_1696333235
{
    /**
     * @var string
     */
    public $comment = '';

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL(): array
    {
        $connection_default = <<<'EOT'

BEGIN;

ALTER TABLE "secret"

  ALTER COLUMN "id" TYPE VARCHAR;

COMMIT;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL(): array
    {
        $connection_default = <<<'EOT'

BEGIN;

CREATE SEQUENCE secret_id_seq;

ALTER TABLE "secret"

  ALTER COLUMN "id" TYPE INTEGER
   USING CASE WHEN trim(id) SIMILAR TO '[0-9]+'
        THEN CAST(trim(id) AS integer)
        ELSE NULL END,

  ALTER COLUMN "id" SET DEFAULT nextval('secret_id_seq'::regclass);

COMMIT;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

}