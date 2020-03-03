<?php
namespace BBS\test\yudai\work\Login;
use BBS\test\yudai\work\Frontpage\Frontpage;
use BBS\Config\Config;
class Login
{
    public function login()
    {
        $frontpage = new Frontpage();
        $config = new Config();
        if (array_key_exists('id', $_POST) && array_key_exists('password', $_POST)) {
            if (($_POST['id'] == '') || ($_POST['password'] == '')) {
                $frontpage->login_inputmiss_page();
                exit();
            }
        }
        if (array_key_exists('id', $_POST) && array_key_exists('password', $_POST)) {
            if (($_POST['id'] == 'user') && ($_POST['password'] == 'password1!')) {
                file_put_contents($config->get_folder_login() . $_POST['id'] . '.txt', $_SERVER['REMOTE_ADDR']);
                $frontpage->login_success_page();
            } else {
                $frontpage->login_failed_page();
            }
        }
    }
    public function login_check()
    {
        $frontpage = new Frontpage();
        $config = new Config();
        if (($_SERVER['REQUEST_URI'] != '/login_page') && ($_SERVER['REQUEST_URI'] != '/login') && ($_SERVER['REQUEST_URI'] != '/login_failed')) {
            if (!file_exists($config->get_folder_login() . 'user.txt')) {
                $frontpage->login_page();
                exit;
            } elseif (!file_get_contents($config->get_folder_login() . 'user.txt') == $_SERVER['REMOTE_ADDR']) {
                $frontpage->login_page();
                exit;
            }
        }
    }
}