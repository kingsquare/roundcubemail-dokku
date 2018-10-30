[![Docker Pulls](https://img.shields.io/docker/pulls/kingsquare/roundcube-dokku.svg)](https://hub.docker.com/r/kingsquare/roundcube-dokku/)

# Roundcube for dokku

Simple dokku configuration wrapper for the upstream official [roundcubemail](https://hub.docker.com/r/roundcube/roundcubemail) image.

This just ensures that the dokku linked container variables are converted to the expected upstream environment variables.

## Configuration

All `ROUNDCUBEMAIL_<var>` env vars are set to `$config[strtolower('<var>')]`. 

i.e.

````shell
ROUNDCUBEMAIL_TEST=1
````

will be 

````php
$config['test'] => '1';
````

If the value can be json decoded to an (assoc) array then this will used as the value.

i.e.

````shell
ROUNDCUBE_ARRAY_VAR="[1,2,3]"
ROUNDCUBE_ASSOC_VAR="{\"key\":\"value\"}"
````

will be 

````php
$config['array_var'] = [1,2,3];
$config['assoc_var'] = ['key' => 'value'];
````

### Link database container (optional)

Requires [mysql plugin](https://github.com/dokku/dokku-mysql) / [mariadb plugin](https://github.com/dokku/dokku-mariadb)

Note: if using mariadb replace mysql with mariadb in commands

    dokku mysql:create <name>
    dokku mysql:link <name> <app>

`DATABASE_URL` is used for configuration value `db_dsnw`

### Link memcached container (optional)

Requires [memcached plugin](https://github.com/dokku/dokku-memcached)

    dokku memcached:create <name>
    dokku memcached:link <name> <app>

`MEMCACHED_URL` is used for `memcache_hosts` configuration.

### Link redis container (optional)

Requires [redis plugin](https://github.com/dokku/dokku-redis)

    dokku redis:create <name>
    dokku redis:link <name> <app>

`REDIS_URL` is used for `redis_hosts` configuration.

### Mount for temp storage (optional)

    dokku storage:mount <app> <host-dir>:/tmp/roundcube-temp

### Mount for SQLite DB (optional)

If using the built in SQLite and you want to persist the database then add a mount to `/var/www/html/db`.

    dokku storage:mount <app> <host-dir>:/var/www/html/db
