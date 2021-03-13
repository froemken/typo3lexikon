<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'typo3lexikon');

// Project repository
set('repository', 'git@github.com:froemken/typo3lexikon.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

set('keep_releases', 5);

// Hosts
host('typo3lexikon.de')
    ->set(
        'shared_files',
        [
            'public/typo3conf/AdditionalConfiguration.php',
        ]
    )
    ->set(
        'shared_dirs',
        [
            'public/fileadmin',
            'public/uploads'
        ]
    )
    ->set('writable_mode', 'chmod')
    ->set('writable_chmod_mode', '0750')
    ->set('writable_chmod_recursive', true)
    ->set(
        'writable_dirs',
        [
            'var/',
            'public/fileadmin/',
            'public/uploads/',
            'public/typo3temp/'
        ]
    )
    ->set(
        'clear_paths',
        [
            'public/typo3temp/*',
            'var/*'
        ]
    )
    ->set('deploy_path', '~/deployer/{{application}}');

// Tasks
desc('Deploy typo3lexikon');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

desc('REMOTE: Execute command <pwd>');
task('pwd', function () {
    $result = run('pwd');
    writeln("Current dir: $result");
});

desc('Download latest SQL Backup');
task('download-sql', function () {
    $dayOfWeek = run('date "+%A"');
    $sqlBackupFile = "~/typo3cms/system/backup/databases/{{application}}.dump.sql.$dayOfWeek.gz";
    if (test("[ ! -f $sqlBackupFile ]")) {
        $dayOfYesterday = run('date -d "yesterday" "+%A"');
        $sqlBackupFile = "~/typo3cms/system/backup/databases/{{application}}.dump.sql.$dayOfYesterday.gz";
    }
    if (test("[ ! -f $sqlBackupFile ]")) {
        writeln("<comment>No SQL file download available</comment>");
        return;
    }
    writeln('Downloading latest SQL backup...');
    download($sqlBackupFile, 'dump.sql.gz');
    writeln('Uncompress SQL backup...');
    runLocally('gunzip dump.sql.gz');
    writeln('Import SQL dump...');
    runLocally('mysql -uroot -proot -hdb < dump.sql');
    runLocally('rm -f dump.sql');
    writeln('Finished');
});

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
