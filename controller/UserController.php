<?php
//Copied from ProjectController.php
require_once 'framework/Controller.php';
require_once 'dao/UserDAO.php';

class UserController extends Controller {

    function run() {
        $action = filter_input(INPUT_GET, 'action');
        $userDAO = new UserDAO();
        switch ($action) {
            case 'save':
                $user = new User($_POST);
                $userDAO->save($user);
                break;
            case 'delete':
                $userId = filter_input(INPUT_GET, 'userId');
                $userDAO->delete($userId);
                break;
        }
        return 'view=UserList';
    }

}

new UserController;
