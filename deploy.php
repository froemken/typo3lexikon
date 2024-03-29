<?php
namespace Deployer;

require 'recipe/typo3.php';

// Import hosts
import('Build/Deployer/hosts.yaml');
localhost('ci');

// Remove php bin path. PHP version will be set through .php-version file on remote server
set('bin/php', '/usr/bin/php82');

// Do not search for www, apache or whatever user. Just use whoami on DF servers
set('http_user', function () {
    return run('whoami');
});

// Config
set('repository', 'https://github.com/froemken/typo3lexikon');
set('shared_files', []);

// Remote tasks
task('deploy:postProcess', function () {
    upload(
        'public/typo3conf/AdditionalConfiguration.php',
        get('release_path') . '/public/typo3conf/AdditionalConfiguration.php'
    );
    // runLocally('scp public/typo3conf/AdditionalConfiguration.php ' . get('hostname') . ':' . get('release_path') . '/public/typo3conf/AdditionalConfiguration.php');

    run('cd ' . get('release_path') . ' && ' . get('bin/php') . ' vendor/bin/typo3cms database:updateschema "*.add,*.change"');
    run('cd ' . get('release_path') . ' && ' . get('bin/php') . ' vendor/bin/typo3cms language:update');
    run('cd ' . get('release_path') . ' && ' . get('bin/php') . ' vendor/bin/typo3cms cache:flush');
});
after('deploy', 'deploy:postProcess');
after('deploy:failed', 'deploy:unlock');

// Add local DEP commands
import('Build/Deployer/local_commands.yaml');
