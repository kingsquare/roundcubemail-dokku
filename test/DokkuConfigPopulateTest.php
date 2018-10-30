<?php

/**
 * Class DokkuConfigPopulateTest
 */
class DokkuConfigPopulateTest extends \PHPUnit\Framework\TestCase
{

  /**
   * @return array
   */
  public function provider()
  {
    return [
      'can use DATABASE_URL' => [
        [
          'DATABASE_URL' => 'mysql://user:pass@host:123/database'
        ],
        [
          'db_dsnw' => 'mysql://user:pass@host:123/database',
        ],
      ],
      'can use MEMCACHED_URL' => [
        [
          'MEMCACHED_URL' => 'memcached://host:123'
        ],
        [
          'memcache_hosts' => ['host:123'],
        ],
      ],
      'can use REDIS_URL' => [
        [
          'REDIS_URL' => 'redis://user:pass@host:123'
        ],
        [
          'redis_hosts' => ['host:123:0:pass'],
        ],
      ],
      'can use ROUNDCUBEMAIL_<key> vars' => [
        [
          'ROUNDCUBEMAIL_test' => true,
        ],
        [
          'test' => true,
        ],
      ],
      'can use ROUNDCUBEMAIL_<key> vars with json value' => [
        [
          'ROUNDCUBEMAIL_test_array' => '["one", "two"]',
          'ROUNDCUBEMAIL_test_object' => '{"one": "two"}',
        ],
        [
          'test_array' => ['one', 'two'],
          'test_object' => ['one' => 'two'],
        ],
      ],
    ];
  }

  /**
   * @dataProvider provider
   *
   * @param array $config
   * @param array $env
   * @param array $expected
   */
  public function test($env, $expected)
  {
    $this->assertSame($expected, DokkuConfig::populate([], $env));
  }
}
