#!/usr/bin/env bash

`php /dokku/env.php`

/docker-entrypoint.sh $@
