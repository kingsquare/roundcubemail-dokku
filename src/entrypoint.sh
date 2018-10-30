#!/usr/bin/env bash

cp /dokku/config.php /var/roundcube/config/00-dokku.php

/docker-entrypoint.sh $@
