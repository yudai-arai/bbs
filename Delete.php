<?php

namespace BBS\test\yudai\work\Delete;

use BBS\test\yudai\work\Frontpage\Frontpage;

class Delete
{
    public function delete_file()
    {
        require_once('Frontpage.php');
        $frontpage = new Frontpage;
        if (!array_key_exists('filename', $_POST)) {
            $frontpage->delete_error_page();
            exit;
        }elseif($_POST['filename'] == '') {
            $frontpage->delete_error_page();
            exit;
        }else{
            foreach ($_POST['filename'] as $value) {
                unlink(get_folder() . $value . '.txt');
                $frontpage->delete_success_page();
                exit;
            }
        }
    
    }
}