<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php

use Model\Boosterpack_model;
use Model\Post_model;
use Model\User_model;

/**
 * Created by PhpStorm.
 * User: mr.incognito
 * Date: 10.11.2018
 * Time: 21:36
 */
class Main_page extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();

        if (is_prod())
        {
            die('In production it will be hard to debug! Run as development environment!');
        }
    }

    public function index()
    {
        $user = User_model::get_user();

        App::get_ci()->load->view('main_page', ['user' => User_model::preparation($user, 'default')]);
    }

    public function get_all_posts()
    {
        $posts =  Post_model::preparation_many(Post_model::get_all(), 'default');
        return $this->response_success(['posts' => $posts]);
    }

    public function get_boosterpacks()
    {
        $posts =  Boosterpack_model::preparation_many(Boosterpack_model::get_all(), 'default');
        return $this->response_success(['boosterpacks' => $posts]);
    }

    public function login1()
    {
        // TODO: task 1, аутентификация
        ?>
            <script>
                let login=document.getElementById('inputEmail').value;
                let password=document.getElementById('inputPassword').value;
                axios.post('/main_page/login.php',login,password)
                    .then(function (response) {
                        if(response.data.user) {
                            location.reload();
                        }
                        setTimeout(function () {
                            $('#loginModal').modal('hide');
                        }, 500);
                    })
            </script>
        <?php
        return $this->response_success();
    }

    public function logout()
    {
        // TODO: task 1, аутентификация
        $_COOKIE['user']='';
    }

    public function comment()
    {
        // TODO: task 2, комментирование
        ?>
        <script>
            $.ajax({
                url: 'main_page/comment.php',
                method: 'post',
                data: {
                    postId: document.getElementById('postId').value,
                    comment: document.getElementById('comment_text').value,
                    user_id: document.getElementById('user_id').value,
                },
                success: function (response) {
                    location.reload();
                }
            });
        </script>
        <?php
    }

    public function like_comment(int $comment_id)
    {
        // TODO: task 3, лайк комментария
        ?>
        <script>
            $.ajax({
                url: 'main_page/comment_like.php',
                method: 'post',
                data: {
                    postId: document.getElementById('postId').value,
                    comment: document.getElementById('comment_text').value,
                    author_id: document.getElementById('author_id').value,
                },
                success: function (response) {
                    location.reload();
                }
            });
        </script>
        <?php
    }

    public function like_post(int $post_id)
    {
        // TODO: task 3, лайк поста
        ?>
        <script>
            $.ajax({
                url: 'main_page/post_like.php',
                method: 'post',
                data: {
                    postId: document.getElementById('postId').value,
                },
                success: function (response) {
                    location.reload();
                }
            });
        </script>
        <?php
    }

    public function add_money()
    {
        // TODO: task 4, пополнение баланса
        ?>
        <script>
            $.ajax({
                url: 'main_page/add_money.php',
                method: 'post',
                data: {
                    amount:document.getElementById('amount_input').value,
                },
                success: function (response) {
                    $sum=response;
                    location.reload();
                }
            });
        </script>
        <?php

        $sum = (float)App::get_ci()->input->post('sum');

    }

    public function get_post(int $post_id) {
        // TODO получения поста по id
    }

    public function buy_boosterpack()
    {
        // Check user is authorize
        if ( ! User_model::is_logged())
        {
            return $this->response_error(System\Libraries\Core::RESPONSE_GENERIC_NEED_AUTH);
        }

        // TODO: task 5, покупка и открытие бустерпака
    }





    /**
     * @return object|string|void
     */
    public function get_boosterpack_info(int $bootserpack_info)
    {
        // Check user is authorize
        if ( ! User_model::is_logged())
        {
            return $this->response_error(System\Libraries\Core::RESPONSE_GENERIC_NEED_AUTH);
        }


        //TODO получить содержимое бустерпака
    }
}
