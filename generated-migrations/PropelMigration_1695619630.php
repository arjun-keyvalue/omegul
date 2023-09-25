<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1695619394.
 * Generated on 2023-09-25 10:57:10 by arjun */
class PropelMigration_1695619630
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

INSERT INTO public.message ("content", user_id, created_at, updated_at) VALUES('hi all!', 1, '2023-09-22 11:06:54.238', '2023-09-22 11:06:54.238');

INSERT INTO public.message ("content", user_id, created_at, updated_at) VALUES('welcome', 1, '2023-09-22 11:07:10.913', '2023-09-22 11:07:10.913');

INSERT INTO public.message ("content", user_id, created_at, updated_at) VALUES('heyy', 2, '2023-09-22 11:07:26.122', '2023-09-22 11:07:26.122');

INSERT INTO public.message ("content", user_id, created_at, updated_at) VALUES('wassup', 2, '2023-09-22 17:09:47.457', '2023-09-22 17:09:47.457');

INSERT INTO public.message ("content", user_id, created_at, updated_at) VALUES('hey', 3, '2023-09-25 10:27:40.280', '2023-09-25 10:27:40.280');

INSERT INTO public.message ("content", user_id, created_at, updated_at) VALUES('hi', 3, '2023-09-25 10:29:36.486', '2023-09-25 10:29:36.486');

INSERT INTO public.message ("content", user_id, created_at, updated_at) VALUES('helloo', 3, '2023-09-25 10:33:48.888', '2023-09-25 10:33:48.888');

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

DELETE FROM public.message WHERE user_id IN (1, 2, 3);

COMMIT;
EOT;

        return [
            'default' => $connection_default,
        ];
    }

}