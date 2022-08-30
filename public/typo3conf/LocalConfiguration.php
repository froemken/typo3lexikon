<?php
return [
    'BE' => [
        'compressionLevel' => '9',
        'debug' => false,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$argon2i$v=19$m=16384,t=16,p=2$NXdiTTdTbzE0dGNPTU4ydA$ltzKsw45OTphok+MxdJAxq9vKjr20UBlxRQmVsvLCb0',
        'lockSSL' => true,
        'lockSSLPort' => 443,
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8mb4',
                'dbname' => '',
                'driver' => 'mysqli',
                'host' => '127.0.0.1',
                'password' => '',
                'port' => 3306,
                'tableoptions' => [
                    'charset' => 'utf8',
                    'collate' => 'utf8_general_ci',
                ],
                'user' => '',
            ],
        ],
    ],
    'EXT' => [],
    'EXTCONF' => [
        'helhum-typo3-console' => [
            'initialUpgradeDone' => '10.4',
        ],
        'lang' => [
            'availableLanguages' => [
                'de',
            ],
        ],
    ],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => '',
            'loginBackgroundImage' => '',
            'loginFootnote' => '',
            'loginHighlightColor' => '',
            'loginLogo' => '',
            'loginLogoAlt' => '',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'scheduler' => [
            'maxLifetime' => '1440',
            'showSampleTasks' => '1',
        ],
        'solr' => [
            'allowSelfSignedCertificates' => '0',
            'includeGlobalQParameterInCacheHash' => '0',
            'monitoringType' => '0',
            'pluginNamespaces' => 'tx_solr',
            'useConfigurationFromClosestTemplate' => '0',
            'useConfigurationMonitorTables' => '',
            'useConfigurationTrackRecordsOutsideSiteroot' => '1',
        ],
    ],
    'FE' => [
        'compressionLevel' => 9,
        'debug' => false,
        'disableNoCacheParameter' => true,
        'enable_mount_pids' => false,
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'GFX' => [
        'processor' => 'GraphicsMagick',
        'processor_allowTemporaryMasksAsPng' => false,
        'processor_colorspace' => 'RGB',
        'processor_effects' => false,
        'processor_enabled' => true,
        'processor_path' => '/usr/bin/',
        'processor_path_lzw' => '/usr/bin/',
    ],
    'LOG' => [
        'TYPO3' => [
            'CMS' => [
                'deprecations' => [
                    'writerConfiguration' => [
                        'notice' => [
                            'TYPO3\CMS\Core\Log\Writer\FileWriter' => [
                                'disabled' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'MAIL' => [
        'defaultMailFromAddress' => 'info@typo3lexikon.de',
        'defaultMailFromName' => 'Stefan Frömken',
        'defaultMailReplyToAddress' => 'info@typo3lexikon.de',
        'defaultMailReplyToName' => 'Stefan Frömken',
        'transport' => 'smtp',
        'transport_sendmail_command' => '',
        'transport_smtp_encrypt' => true,
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'hash' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\FileBackend',
                ],
                'pages' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\FileBackend',
                    'options' => [
                        'compression' => '__UNSET',
                    ],
                ],
                'pagesection' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\FileBackend',
                    'options' => [
                        'compression' => '__UNSET',
                    ],
                ],
            ],
        ],
        'ddmmyy' => 'd.m.Y',
        'devIPmask' => '',
        'displayErrors' => 0,
        'encryptionKey' => '85ba9f5bc7d2509971f32e594b4917873a90b8143a5d9528da18e76b215882a3e090ec73f8af9279ec66980c51d3e97d',
        'exceptionalErrors' => 4096,
        'features' => [
            'TypoScript.strictSyntax' => true,
            'redirects.hitCount' => false,
            'security.frontend.keepSessionDataOnLogout' => false,
            'simplifiedControllerActionDispatching' => false,
            'unifiedPageTranslationHandling' => true,
        ],
        'loginCopyrightWarrantyProvider' => 'Stefan Frömken',
        'loginCopyrightWarrantyURL' => 'https://www.typo3lexikon.de',
        'phpTimeZone' => 'Europe/Berlin',
        'sitename' => 'Stefans TYPO3 Seite',
        'systemLocale' => 'de_DE.UTF-8',
        'systemMaintainers' => [
            1,
        ],
    ],
];
