<?php
namespace Deployer;

require 'recipe/typo3.php';

// DocumentRoot / WebRoot for the TYPO3 installation
set('typo3_webroot', 'public');

// Config
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

task('deploy:uploadConfig', function () {
    upload(
        'public/typo3conf/AdditionalConfiguration.php',
        'public/typo3conf/AdditionalConfiguration.php'
    );
});

/**
 * Main TYPO3 task
 */
desc('Deploys your project');
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:publish',
    'deploy:uploadConfig'
]);

// Hosts
host('sfroemken.de')
    ->set('remote_user', 'froemken')
    ->set('deploy_path', '~/httpdocs/typo3lexikon.sfroemken.de');

// Hooks
after('deploy:failed', 'deploy:unlock');
