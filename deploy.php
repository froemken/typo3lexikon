<?php
namespace Deployer;

require 'recipe/typo3.php';

// Import hosts
import('Build/Deployer/hosts.yaml');
localhost('ci');

// Remove php bin path. PHP version will be set through .php-version file on remote server
set('bin/php', '');

// Config
set('repository', 'https://github.com/froemken/typo3lexikon');
set('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Remote tasks
task('deploy:postProcess', function () {
    // upload() does not work because of missing rsync at target host
    run('scp public/typo3conf/AdditionalConfiguration.php ' . $this->get('hostname') . ':' . get('release_path') . '/public/typo3conf/AdditionalConfiguration.php');

    run('cd ' . get('release_path') . ' && vendor/bin/typo3cms database:updateschema "*.add,*.change"');
    run('cd ' . get('release_path') . ' && vendor/bin/typo3cms language:update');
    run('cd ' . get('release_path') . ' && vendor/bin/typo3cms cache:flush');
});
after('deploy', 'deploy:postProcess');
after('deploy:failed', 'deploy:unlock');

// Add local DEP commands
import('Build/Deployer/local_commands.yaml');
