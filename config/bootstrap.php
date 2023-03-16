<?php
use Cake\Core\Configure;
use Cake\Routing\Router;

require_once 'finder_access.php';

Configure::write('Summernote.elFinder', [
    'debug' => false,
    'roots' => [
        [
            'primary'       => true,
            'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
            'alias'         => __('Uploads folder'),
            'path'          => ROOT.DS.Configure::read('App.webroot').DS.'files'.DS, // path to files (REQUIRED)
            'URL'           => Router::url('/', true).'files/', // URL to files (REQUIRED)
            'uploadDeny'    => array('all'),                // All Mimetypes not allowed to upload
            'uploadAllow'   => array('image', 'text/plain'),// Mimetype `image` and `text/plain` allowed to upload
            'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
            'accessControl' => 'finder_access'                     // disable and hide dot starting files (OPTIONAL)
        ]
    ]
]);
