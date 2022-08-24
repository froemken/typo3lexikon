<?php
namespace Deployer;

require 'recipe/typo3.php';

// Config

set('repository', 'https://github.com/froemken/typo3lexikon');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('sfroemken.de')
    ->set('remote_user', 'froemken')
    ->set('deploy_path', '~/httpdocs/typo3lexikon.sfroemken.de');

// Hooks

after('deploy:failed', 'deploy:unlock');
