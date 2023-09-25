
BEGIN;

-----------------------------------------------------------------------
-- users
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "users" CASCADE;

CREATE TABLE "users"
(
    "id" serial NOT NULL,
    "username" VARCHAR(255) NOT NULL,
    "ip_address" VARCHAR(15) NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- message
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "message" CASCADE;

CREATE TABLE "message"
(
    "id" serial NOT NULL,
    "content" VARCHAR(255) NOT NULL,
    "user_id" INTEGER NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- secret
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "secret" CASCADE;

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
