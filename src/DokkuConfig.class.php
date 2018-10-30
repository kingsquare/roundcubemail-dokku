<?php

/**
 * Class DokkuConfig
 */
class DokkuConfig {

  /**
   * @param array $config
   * @param array $env
   *
   * @return array
   */
  public static function populate(array $config = [], array $env = []) : array
  {
    // support dokku linked database container (mysql/mariadb)
    if (array_key_exists('DATABASE_URL', $env)) {
      $config['db_dsnw'] = $env['DATABASE_URL'];
    }

    // support dokku linked memcached container
    if (array_key_exists('MEMCACHED_URL', $env)) {
      $params = parse_url($env['MEMCACHED_URL']);
      if ($params) {
        $config['memcache_hosts'] = [implode(':', [$params['host'], $params['port']])];
      }
    }

    // support dokku linked redis container
    if (array_key_exists('REDIS_URL', $env)) {
      $params = parse_url($env['REDIS_URL']);
      if ($params) {
        $config['redis_hosts'] = [implode(':', [$params['host'], $params['port'], 0, $params['pass']])];
      }
    }

    // map all ROUNDCUBEMAIL_<key> env vars to $config[<key]
    foreach (array_filter($env, function ($value, $key) {
      return strpos($key, 'ROUNDCUBEMAIL_') === 0;
    }, ARRAY_FILTER_USE_BOTH) as $key => $value) {
        $config[strtolower(str_replace('ROUNDCUBEMAIL_', '', $key))] = $value;
    }
    return $config;
  }
}
