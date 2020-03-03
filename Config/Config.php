<?php

namespace BBS\Config;

class Config
{
    public function get_folder()
    {
        return 'C:\xampp\htdocs\todo\BBS\text\\';
    }

    public function get_folder_login()
    {
        return 'C:\xampp\htdocs\todo\BBS\login\\';
    }

    public function get_url($action)
    {
        return 'http://localhost' . $action;
    }
}

