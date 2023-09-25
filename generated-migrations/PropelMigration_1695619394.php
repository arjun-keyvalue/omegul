<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1695619394.
 * Generated on 2023-09-25 10:53:14 by arjun */
class PropelMigration_1695619394
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

INSERT INTO public.users (username, ip_address, created_at, updated_at) VALUES('Admin', '192.168.2.91', '2023-09-22 11:06:19.236', '2023-09-22 11:06:19.236');

INSERT INTO public.users (username, ip_address, created_at, updated_at) VALUES('SuperMauveOx', '192.168.2.92', '2023-09-22 11:07:21.320', '2023-09-22 11:07:21.320');

INSERT INTO public.users (username, ip_address, created_at, updated_at) VALUES('ElasticDonkey', '192.168.29.112', '2023-09-25 10:27:15.785', '2023-09-25 10:27:15.785');

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

DELETE FROM public.users WHERE username IN ('Admin', 'SuperMauveOx', 'ElasticDonkey');

COMMIT;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

}