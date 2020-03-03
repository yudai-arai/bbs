<?php

namespace BBS\test\yudai\work\Post;

use BBS\test\yudai\work\Frontpage\Frontpage;
use BBS\Config\Config;

class Post
{
    public function save_page()
    {
    $config = new Config();
    $frontpage = new Frontpage;
    if ($_POST['text'] == '') {
        echo '本文を入力してください。<br>';
        echo '<a href="/input">入力画面はこちら</a>';
        exit;
    }
    file_put_contents($config->get_folder() . date("YmdHis") . '.txt', $_POST['nickname'] .'|'.$_POST['title'] .'|'.$_POST['text']);
    echo '<html>
    <body>
    <p>保存しました</p>';
    $frontpage->echo_break_line('<a href="/input">入力画面はこちら</a>');
    $frontpage->list_page_link();
    echo '</body>
    </html>';
    }

    public function contents_page()
    {
    $frontpage = new Frontpage;
    $config = new Config();
    echo "<html>
        <body>";
    if (array_key_exists('text', $_GET)) {
        $filecontents = htmlspecialchars(file_get_contents($config->get_folder().$_GET['text']));
        $filecontent = explode( '|', $filecontents);
        echo 'ニックネーム：' . $filecontent[0];
        echo '<hr>';
        echo 'タイトル：' . $filecontent[1];
        echo '<hr>';
        $frontpage->echo_break_line ('コメント：' . $filecontent[2]);
        $frontpage->list_page_link();
    } else {
        echo 'データがありません。<br>';
        $frontpage->list_page_link();
    }
    echo "</body>
        </html>";
    }
}