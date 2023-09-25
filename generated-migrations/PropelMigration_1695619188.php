<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1695619188.
 * Generated on 2023-09-25 10:49:48 by arjun */
class PropelMigration_1695619188
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

CREATE TABLE "users"
(
    "id" serial NOT NULL,
    "username" VARCHAR(255) NOT NULL,
    "ip_address" VARCHAR(15) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

CREATE TABLE "message"
(
    "id" serial NOT NULL,
    "content" VARCHAR(255) NOT NULL,
    "user_id" INTEGER NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

CREATE TABLE "secret"
(
    "id" serial NOT NULL,
    "file_name" VARCHAR(255) NOT NULL,
    "file_type" VARCHAR(255) NOT NULL,
    "user_id" INTEGER NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

ALTER TABLE "message" ADD CONSTRAINT "message_fk_69bd79"
    FOREIGN KEY ("user_id")
    REFERENCES "users" ("id");

ALTER TABLE "secret" ADD CONSTRAINT "secret_fk_69bd79"
    FOREIGN KEY ("user_id")
    REFERENCES "users" ("id");

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

DROP TABLE IF EXISTS "users" CASCADE;

DROP TABLE IF EXISTS "message" CASCADE;

DROP TABLE IF EXISTS "secret" CASCADE;

COMMIT;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

}