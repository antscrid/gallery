<?php
class Controller
{
    public $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }
    public function process()
    {
        $pageAction = $this->page->getPath() . "Action";
        if (method_exists($this, $pageAction)) {
            $this->$pageAction();
        } else {
            $this->notFoundAction();
        }
    }
    //show the index page
    private function indexAction()
    {
        $this->_render('view/index.php', [
            'title' => 'Image Gallery',
            'image' => new Image(),
            'pagination' => new Pagination(),
        ]);
    }
    //show the form page
    private function formAction()
    {
        $this->_render('view/form.php', [
            'errors' => App::get('session')->messages()
        ]);
    }
    //show the login page
    private function loginAction()
    {
        $this->_render('view/login.php', [
            'errors' => App::get('session')->messages()
        ]);
    }
    //show the signup page
    private function registerAction()
    {
        $this->_render('view/register.php', [
            'errors' => App::get('session')->messages()
        ]);
    }
    //image validation
    private function processAction()
    {
        $request = $_REQUEST;
        if (($valid = App::get('form')->imgValidation($request)) === true) {
            if (App::get('image')->save()) {
                header('Location: /');
            } else {
                header('Location: /form');
            }
        } else {
            header('Location: /');
        }
    }
    /**
     * authorization process
     */
    private function processLoginAction()
    {
        $post = $_POST;
        if (App::get('form')->loginValidation($post) && App::get('user')->auth($post['login'], $post['pass'])) {
            header('Location: /');
        } else {
            header('Location: /login');
        }
    }
    /**
     * Logout user
     */
    private function logoutAction()
    {
        App::get('user')->logout();
        App::get('session')->setMessage('Logged out successfully');
        $this->page->redirect('/');
    }
    //signup process function
    private function processRegisterAction()
    {
        $post = $_POST;
        $user=new User();
        if (Form::signupValidation($post) && $user->create($post['login'], $post['pass'])) {
            header('Location: /');
        } else {
            header('Location: /register');
        }
    }
    //image delete function
    private function removeImageAction()
    {
        $id = $_REQUEST['id'];
        App::get('image')->delete($id);
        $this->page->redirect('/');
    }
    private function notFoundAction()
    {
        $this->_render('view/404.php');
    }

    private function _render($template, $params = [])
    {
        extract($params);
        include($template);
    }
}