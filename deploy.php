<?php
namespace Deployer;

require 'recipe/symfony4.php';

// Project name
set('application', 'tvshow-db');

// Project repository
set('repository', 'https://github.com/O-clock-Hyperion/tvshow-db.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', ["public/uploads"]);

// Writable dirs by web server 
add('writable_dirs', ["public/uploads"]);


// Hosts

host('192.168.1.44')
    ->user('ubuntu')
    ->set('deploy_path', '~/{{application}}');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

