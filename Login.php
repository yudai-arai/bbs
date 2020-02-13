<?php
class Login
{
    public function login()
    {
        $frontpage = new Frontpage();
        if (array_key_exists('id', $_POST) && array_key_exists('password', $_POST)) {
            if (($_POST['id'] == '') || ($_POST['password'] == '')) {
                $frontpage->login_inputmiss_page();
                exit();
            }
        }
        if (array_key_exists('id', $_POST) && array_key_exists('password', $_POST)) {
            if (($_POST['id'] == 'user') && ($_POST['password'] == 'password1!')) {
                file_put_contents(get_folder_login() . $_POST['id'] . '.txt', $_SERVER['REMOTE_ADDR']);
                $frontpage->login_success_page();
            } else {
                $frontpage->login_failed_page();
            }
        }
    }
}