<?php

namespace BBS\test\yudai\work\Delete;

use BBS\test\yudai\work\Frontpage\Frontpage;
use BBS\Config\Config;

class Delete
{
    public function delete_file()
    {
        $frontpage = new Frontpage;
        $config = new Config();
        if (!array_key_exists('filename', $_POST)) {
            $frontpage->delete_error_page();
            exit;
        }elseif($_POST['filename'] == '') {
            $frontpage->delete_error_page();
            exit;
        }else{
            foreach ($_POST['filename'] as $value) {
                unlink($config->get_folder() . $value . '.txt');
                $frontpage->delete_success_page();
                exit;
            }
        }
    
    }
}