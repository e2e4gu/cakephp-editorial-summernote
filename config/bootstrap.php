<?php
use Cake\Core\Plugin;

Plugin::loadAll([
    ['ignoreMissing' => true, 'bootstrap' => true],
    'Editorial/Core' => ['routes' => true],
]);
