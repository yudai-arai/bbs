<?php

namespace BBS\test\yudai\work\Frontpage;

use BBS\Config\Config;

class Frontpage
{
    public function input_page()
    {
        echo "<html>";
        echo "<body>";
        echo("<form action='/save' method='post'>");
        $this->echo_break_line("ニックネーム：<textarea name='nickname'></textarea>");
        $this->echo_break_line("タイトル：<textarea name='title'></textarea>");
        $this->echo_break_line("コメント：<textarea name='text'></textarea>");
        $this->echo_break_line("<input type='submit' value='送信'>");
        echo "</form>";
        $this->list_page_link();
        echo "</body>";
        echo "</html>";
    }

    public function echo_break_line($text)
    {
        echo $text;
        echo '<br>';
        echo '<br>';
    }

    public function echo_pipeline($text)
    {
        echo $text;
        echo '|';
    }

    public function list_page()
    {
        $config = new Config();
        echo "<html>
       <body>";
        $list = glob($config->get_folder() . '*.txt');
        echo("<form action='/list' method='POST'>");
        if (array_key_exists('search_file', $_POST)) {
            echo("検索条件入力：<input type='text' name='search_file' value='{$_POST['search_file']}'>");
        } else {
            echo("検索条件入力：<input type='text' name='search_file'>");
        }
        $this->echo_break_line("<input type='submit' value='検索'>");
        $newlist = array();
        if (array_key_exists('search_file', $_POST)) {
            if ($_POST['search_file'] != '') {
                foreach ($list as $value) {
                    if (strpos($value, $_POST['search_file']) !== false) {
                        array_push($newlist, $value);
                        $list = $newlist;
                    }
                }
            }
        }
        $cnt = count($list);
        echo '</form>';
        echo '<form action="/delete" method="post">';
        $this->echo_break_line('<input type="submit" value="削除"></input>');
        if (!(array_key_exists('page', $_GET))) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $limit = 10;
        $maxpage = $cnt / $limit;
        $maxpage = floor($maxpage);
        if (($cnt % $limit) != 0) {
            $maxpage += 1;
        }
        $start = $limit * ($page - 1);
        if ($page > $maxpage) {
            echo '<p>データがありません。</p>';
        } else {
            for ($index = 0; $index < $limit; $index++) {
                if (($start + $index + 1) <= $cnt) {
                    $name = $list[$start + $index];
                    echo('<a href= "' . $config->get_url('/contents') . '?text=' . basename($name) . '"' . '>' . basename($name, ".txt") . '</a>');
                    $this->echo_break_line('<input type="checkbox"  name="filename[]" value="' . basename($name, ".txt") . '">');
                } else {
                    break;
                }
            }
        }
        echo '</form>';
        if ($page > 1) {
            $this->echo_pipeline('<a href="' . $config->get_url('/list') . '?page=' . ($page - 1) . '">前へ</a>');
        }
        for ($link = 0; $link < $maxpage; $link++) {
            $page_num = $link + 1;
            $this->echo_pipeline('<a href="' . $config->get_url('/list') . '?page=' . $page_num . '"' . '>' . $page_num . '</a>');
        }
        if ($page < $maxpage) {
            echo '<a href="' . $config->get_url('/list') . '?page=' . ($page + 1) . '">次へ</a>';
        }
        echo '<br>';
        echo "<input type=\"submit\" onclick=\"location.href='" . $config->get_url('/input') . "'\" value=\"追加\">";
        echo "<input type=\"submit\" onclick=\"location.href='" . $config->get_url('/logout') . "'\" value=\"ログアウト\">
        </body>
        </html>";
    }

    public function list_page_link()
    {
        echo '<a href="/list">一覧はこちら</a>';
    }

    public function delete_success_page()
    {
        echo "<html>
        <body>";
        echo 'ファイルの削除に成功しました。<br>';
        $this->list_page_link();
        echo'</body>
        </html>';
    }

    public function delete_error_page()
    {
        echo "<html>
        <body>";
        echo '削除するファイルを指定してください。<br>';
        $this->list_page_link();
        echo'</body>
        </html>';
    }

    public function login_success_page()
    {
        echo '<html>
    <body>';
        echo 'ログインしました。<br>';
        echo '<a href="/input">入力画面はこちら</a>';
        echo "</body>
        </html>";
    }

    public function login_inputmiss_page()
    {
        echo '<html>
    <body>';
        echo 'ログインIDとパスワードを入力してください。<br>';
        echo '<a href="/login_page">再ログインはこちら</a>';
        echo "</body>
        </html>";
    }

    public function login_failed_page()
    {
        echo '<html>
    <body>';
        echo 'ログインに失敗しました。';
        echo '<a href="/login_page">再ログインはこちら</a>';
        echo "</body>
        </html>";
    }

    public function logout_page()
    {
        $config = new Config();
        echo '<html>
    <body>';
        unlink($config->get_folder_login() . 'user.txt');
        echo 'ログアウトしました。<br>';
        echo '<a href="/login_page">ログインはこちら</a>
    </body>
    </html>';
    }
    function login_page()
    {
    echo "<html>";
    echo "<body>";
    echo("<form action='/login' method='post'>");
    $this->echo_break_line("ID：<input type='text' name='id'>");
    $this->echo_break_line("パスワード：<input type='text' name='password'>");
    echo "<input type='submit' value='ログイン'>";
    echo "</body>";
    echo "</html>";
    }
}