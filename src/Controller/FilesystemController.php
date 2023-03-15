<?php
namespace Editorial\Summernote\Controller;

use Editorial\Summernote\Controller\AppController;
use Cake\Core\Plugin;
use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use elFinder;
use elFinderConnector;

class FilesystemController extends AppController {

    public function callback()
    {
        if(Plugin::isLoaded('Passengers')){
            $session = $this->request->session();
            $user = $session->read('Auth.User');
            if(!isset($user['id'])){
                exit;
            }
        }

        $opts = Configure::read('Summernote.elFinder');
        foreach($opts['roots'] as $key=>$root){
            if(isset($root['primary'])||($root['primary'] === true)){
                if(Plugin::isLoaded('Passengers')&&($user['role_id'] != 4)){
                    $root['path'] .= DS.'users_content'.DS.'user_'.$user['id'];
                    $root['URL'] .= 'users_content/user_'.$user['id'].'/';
                }
            }
            if($dir = new Folder($root['path'], true, 0755)){
                $opts['roots'][$key]['path'] = $root['path'];
                $opts['roots'][$key]['URL'] = $root['URL'];
            }
            unset($dir);
        }

        // run elFinder
        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }
}
