<?php
namespace Deployer;

require 'recipe/typo3.php';

if (
    array_key_exists('HTTP_HOST', $_SERVER)
    && preg_match('@^.*\.ddev\.site$@', $_SERVER['HTTP_HOST'])
) {
    echo 'Do not deploy locally. Use GIT push and wait for Github actions';
    exit;
}

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

task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'deploy:publish',
]);

// Hosts
host('sfroemken.de')
    ->set('remote_user', 'froemken')
    ->set('deploy_path', '~/httpdocs/typo3lexikon.sfroemken.de');

// Hooks
after('deploy:failed', 'deploy:unlock');
