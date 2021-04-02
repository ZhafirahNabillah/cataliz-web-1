<?php

namespace Deployer;

// Include the Laravel & rsync recipes
require 'recipe/laravel.php';
require 'recipe/rsync.php';

set('application', 'cataliz-web');
set('ssh_multiplexing', true); // Speed up deployment

set('rsync_src', function () {
    return __DIR__; // If your project isn't in the root, you'll need to change this.
});

// Configuring the rsync exclusions. 
// You'll want to exclude anything that you don't want on the production server.  
add('rsync', [
    'exclude' => [
        '.git',
        '/.env',
        '/storage/',
        '/vendor/',
        '/node_modules/',
        '.github',
        'deploy.php',
    ],
]);

// Set up a deployer task to copy secrets to the server. 
// Grabs the dotenv file from the github secret
task('deploy:secrets', function () {
    file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path') . '/shared');
});

// Hosts
host('app.cataliz.id') // Name of the server or domain
    ->hostname('52.205.83.22') // Hostname or IP address
    ->stage('staging') // Deployment stage (production, staging, etc)
    ->user('ubuntu') // SSH user
    ->set('deploy_path', '/var/www/html'); // Deploy path

// Tasks
after('deploy:failed', 'deploy:unlock'); // Unlock after failed deploy

desc('Deploy the application');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'rsync', // Deploy code & built assets
    'deploy:secrets', // Deploy secrets
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link', // |
    'artisan:view:cache',   // |
    'artisan:cache:clear',  // | Laravel specific steps
    'artisan:config:cache', // | 
    #'artisan:optimize',     // |
    #'artisan:migrate',      // |
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'php-symlink',
    #'update',
    'restart-nginx',
]);

task ('php-symlink', function(){
    run('sudo ln -s /var/www/html/db-cataliz /var/www/html/current/public');
    #run('sudo mv /var/www/html/current/public/phpmyadmin /var/www/html/current/public/db-cataliz');
});

task ('update', function(){
    run('sudo apt update');
});

task ('restart-nginx',function(){
    run('sudo systemctl reload nginx');
});
