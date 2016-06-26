<?php
use Cake\Core\Plugin;
use Cake\Core\Configure;
use Cake\Routing\Router;

Plugin::loadAll([
    ['ignoreMissing' => true, 'bootstrap' => true],
    'Editorial/Core' => ['routes' => true],
]);

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

function finder_access($attr, $path, $data, $volume){
    return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
        ? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
        :  null;                                    // else elFinder decide it itself
}
