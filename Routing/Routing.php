<?php

namespace BBS\Routing;



use BBS\test\yudai\work\Login\Login;
use BBS\test\yudai\work\Post\Post;
use BBS\test\yudai\work\Frontpage\Frontpage;
use BBS\test\yudai\work\Delete\Delete;

class Routing
{
    public function execute()
    {
        $login = new Login();
        $post = new Post();
        $frontpage = new Frontpage();
        $delete = new Delete();

        if (!array_key_exists('action', $_GET)) {
            $_GET['action'] = 'input';
        }

        $login->login_check();
        
        if ($_GET['action'] == 'input') {
            $frontpage->input_page();
        } elseif ($_GET['action'] == 'login_page') {
            $frontpage->login_page();
        } elseif ($_GET['action'] == 'login') {
            $login->login();
        } elseif ($_GET['action'] == 'login_failed') {
            $frontpage->login_failed_page();
        } elseif ($_GET['action'] == 'logout') {
            $frontpage->logout_page();
        } elseif ($_GET['action'] == 'save') {
            $post->save_page();
        } elseif ($_GET['action'] == 'list') {
            $frontpage->list_page();
        } elseif ($_GET['action'] == 'delete') {
            $delete->delete_file();
        } elseif ($_GET['action'] == 'contents') {
            $post->contents_page();
        }
    }
}