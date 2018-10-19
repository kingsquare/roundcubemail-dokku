<?php

$DATABASE_URL = getenv('DATABASE_URL');

if ( ! empty($DATABASE_URL)) {
  $params = parse_url($DATABASE_URL);
  if ($params) { // invalid URL
    echo 'export ROUNDCUBEMAIL_DB_TYPE=' . $params['scheme'] . PHP_EOL;
    echo 'export ROUNDCUBEMAIL_DB_HOST=' . $params['host'] . PHP_EOL;
    echo 'export ROUNDCUBEMAIL_DB_USER=' . $params['user'] . PHP_EOL;
    echo 'export ROUNDCUBEMAIL_DB_PASSWORD=' . $params['pass'] . PHP_EOL;
    echo 'export ROUNDCUBEMAIL_DB_NAME=' . $params['path'] . PHP_EOL;
    echo 'export ROUNDCUBEMAIL_DSNW=' . $DATABASE_URL . PHP_EOL;
  }
}

// support only setting a default host i.e. imap server === smtp server
$DEFAULT_HOST = getenv('ROUNDCUBEMAIL_DEFAULT_HOST');
$SMTP_SERVER = getenv('ROUNDCUBEMAIL_SMTP_SERVER');
if (empty($SMTP_SERVER)) {
  echo 'export ROUNDCUBEMAIL_SMTP_SERVER=' . $DEFAULT_HOST . PHP_EOL;
}
