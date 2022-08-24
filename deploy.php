<?php
namespace Deployer;

require 'recipe/typo3.php';

// DocumentRoot / WebRoot for the TYPO3 installation
set('typo3_webroot', 'public');

// Config
set('repository', 'https://github.com/froemken/typo3lexikon');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
host('sfroemken.de')
    ->set('remote_user', 'froemken')
    ->set('deploy_path', '~/httpdocs/typo3lexikon.sfroemken.de')
    ->set('ssh_multiplexing', false); // GitHub action seems to use an old OpenSSH version

// Hooks
after('deploy:failed', 'deploy:unlock');
