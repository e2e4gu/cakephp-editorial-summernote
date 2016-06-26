<?php
use Cake\Routing\Router;

Router::plugin('Editorial/Summernote', function ($routes) {
	$routes->fallbacks();
});
Router::connect('summernote/files/list', ['plugin' => 'Editorial/Summernote', 'controller' => 'Filesystem', 'action' => 'callback']);
