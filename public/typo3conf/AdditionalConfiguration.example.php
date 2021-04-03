<?php

if (getenv('IS_DDEV_PROJECT') == 'true') {
    $GLOBALS['TYPO3_CONF_VARS'] = array_replace_recursive(
        $GLOBALS['TYPO3_CONF_VARS'],
        [
            'BE' => [
                'debug' => true
            ],
            'DB' => [
                'Connections' => [
                    'Default' => [
                        'dbname' => 'db',
                        'host' => 'db',
                        'password' => 'db',
                        'port' => '3306',
                        'user' => 'db',
                    ],
                ],
            ],
            'FE' => [
                'debug' => true
            ],
            // This GFX configuration allows processing by installed ImageMagick 6
            'GFX' => [
                'processor' => 'ImageMagick',
                'processor_path' => '/usr/bin/',
                'processor_path_lzw' => '/usr/bin/',
            ],
            // This mail configuration sends all emails to mailhog
            'MAIL' => [
                'transport' => 'smtp',
                'transport_smtp_server' => 'localhost:1025',
            ],
            'SYS' => [
                'trustedHostsPattern' => '.*.*',
                'devIPmask' => '*',
                'displayErrors' => 1,
            ],
        ]
    );
}

call_user_func(function () {
    $apcuBackend = [
        'backend' => \TYPO3\CMS\Core\Cache\Backend\ApcuBackend::class,
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
        'group' => 'system',
        'options' => [
            'defaultLifetime' => 0
        ]
    ];
    $redisBackend = [
        'backend' => \TYPO3\CMS\Core\Cache\Backend\RedisBackend::class,
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
        'groups' => ['pages'],
        'options' => [
            'hostname' => 'redis',
            'port' => 6379,
            'persistentConnection' => false,
            'database' => 3,
            'compression' => false,
            'compressionLevel' => -1
        ]
    ];

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['hash'] = $redisBackend;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['pages'] = $redisBackend;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['pagesection'] = $redisBackend;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['rootline'] = $redisBackend;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['imagesizes'] = $redisBackend;
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['imagesizes']['group'] = 'lowlevel';

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase'] = $apcuBackend;
});

