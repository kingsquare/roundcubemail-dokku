[![Docker Pulls](https://img.shields.io/docker/pulls/kingsquare/roundcube-dokku.svg)](https://hub.docker.com/r/kingsquare/roundcube-dokku/)

# Roundcube for dokku

Simple wrapper for the upstream official [roundcubemail](https://hub.docker.com/r/roundcube/roundcubemail) image.

This just ensures that the dokku database environment variables are converted to the expected upstream environment variables.

i.e. `DATABASE_URL` is extracted to

    ROUNDCUBEMAIL_DB_TYPE
    ROUNDCUBEMAIL_DB_HOST
    ROUNDCUBEMAIL_DB_USER
    ROUNDCUBEMAIL_DB_PASSWORD
    ROUNDCUBEMAIL_DB_NAME
    ROUNDCUBEMAIL_DSNW

And this all because you can not just set `ROUNDCUBEMAIL_DSNW`

## NOTES

### SQLite

If using the built in SQLite and you want to persist the database then add a mount to `/var/www/html/db`.

    dokku storage:mount <app> <host-dir>:/var/www/html/db
