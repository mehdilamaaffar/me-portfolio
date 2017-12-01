<?php

if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

return [
    'portfolio_name' => 'ME portfolio',
    'portfolio_desc' => ', welcome to photography portfolio!',
    'photos_path' => 'repository' . DS . 'photos' . DS,
    'thumbnails_path' => 'repository' . DS . 'photos' . DS . 'thumbnails' . DS,
    'profile_path' => 'repository' . DS . 'profile' . DS,
];
