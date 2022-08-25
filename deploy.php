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
set('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Remote tasks
task('deploy:postProcess', function () {
    upload(
        'public/typo3conf/AdditionalConfiguration.php',
        get('release_path') . '/public/typo3conf/AdditionalConfiguration.php'
    );
    run('cd ' . get('release_path') . ' && vendor/bin/typo3cms database:updateschema "*.add,*.change"');
    run('cd ' . get('release_path') . ' && vendor/bin/typo3cms language:update');
    run('cd ' . get('release_path') . ' && vendor/bin/typo3cms cache:flush');
});
after('deploy', 'deploy:postProcess');
after('deploy:failed', 'deploy:unlock');

// Local tasks
task('updateTypo3', function () {
    runLocally('composer update typo3/cms-* --with-all-dependencies --profile');
});
