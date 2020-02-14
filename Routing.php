<?php
require_once('../config.php');
require_once('../Post.php');
require_once('../Frontpage.php');
require_once('../Delete.php');
require_once('../Login.php');

class Routing
{
    public function execute()
    {
        $post = new Post();
        $login = new Login();
        $frontpage = new Frontpage();
        $delete = new Delete();

        if (!array_key_exists('action', $_GET)) {
            $_GET['action'] = 'input';
        }

        if (($_GET['action'] != 'login_page') && ($_GET['action'] != 'login') && ($_GET['action'] != 'login_failed')) {
            if (!file_exists(get_folder_login() . 'user.txt')) {
                $frontpage->login_page();
                exit;
            } elseif (!file_get_contents(get_folder_login() . 'user.txt') == $_SERVER['REMOTE_ADDR']) {
                $frontpage->login_page();
                exit;
            }
        }

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