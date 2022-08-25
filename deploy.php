<?php
namespace Deployer;

require 'recipe/typo3.php';

// DocumentRoot / WebRoot for the TYPO3 installation
set('typo3_webroot', 'public');

// Hosts
host('sfroemken.de')
    ->set('remote_user', 'froemken')
    ->set('deploy_path', '~/httpdocs/typo3lexikon.sfroemken.de');

// Config
set('repository', 'https://github.com/froemken/typo3lexikon');
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

task('deploy:uploadConfig', function () {
    upload(
        'public/typo3conf/AdditionalConfiguration.php',
        get('release_path') . '/public/typo3conf/AdditionalConfiguration.php'
    );
});

after('deploy', 'deploy:uploadConfig');

// Hooks
after('deploy:failed', 'deploy:unlock');
