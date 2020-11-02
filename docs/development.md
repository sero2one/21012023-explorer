# Development

Currently the instructions are for Valet

```bash
git clone https://github.com/ArkEcosystem/explorer.ark.io.git
cd explorer.ark.io
composer install
yarn install

cp .env.example .env
php artisan key:generate
php artisan migrate:fresh
## You can run these commands to create a core database with fake data (change EXPLORER_DB_DATABASE to your actual database name))
# php artisan migrate --path=tests/migrations --database=explorer
# composer play
php artisan storage:link
yarn run watch

valet link explorer-ark-io
```

*Important:* You will need access to a Core Postgres database, or use the commented lines above to fill it with dummy data. The details can be specified in the `.env` file under `EXPLORER_DB_*`.

## Caching

Before access the Explorer you'll need to cache data that is accessed a lot. You can read more about caching at our [Cache Documentation](./cache.md).

Afterwards, you can navigate to `explorer-ark-io.test` in your browser to see it in action.