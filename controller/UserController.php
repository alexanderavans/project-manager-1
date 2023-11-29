<?php
//Copied from ProjectController.php
require_once 'framework/Controller.php';
require_once 'dao/UserDAO.php';

class UserController extends Controller
{

  function run()
  {
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
      case 'login':
          // Get the username and password from the form
          $username = filter_input(INPUT_POST, 'username');
          $password = filter_input(INPUT_POST, 'password');

          $result = $userDAO->login($username, $password);

          // Check the result of the login attempt
          if ($result === 'success') {
            return 'view=Login';
          } elseif ($result === 'error') {
            $errorMessage = "Invalid username or password";
          }
          return 'view=Login&error=' . urlencode($errorMessage);
        break;
      case 'logout':
        $userDAO->logout();
        return 'view=Login';
        break;
    }
    return 'view=UserList';
  }
}

new UserController;
