<?php
use Cake\Routing\Router;

Router::plugin('Editorial/Summernote', function ($routes) {
	$routes->fallbacks();
});
