<?php

namespace BBS\Config;

class Config
{
    public function get_folder()
    {
        return 'C:\xampp\htdocs\BBS\text\\';
    }

    public function get_folder_login()
    {
        return 'C:\xampp\htdocs\BBS\login\\';
    }

    public function get_url($action)
    {
        return 'http://localhost/BBS/public/index.php?action=' . $action;
    }
}

