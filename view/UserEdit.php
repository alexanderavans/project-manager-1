<?php
//Copied from ProjectEdit.php
require_once 'framework/View.php';
require_once 'dao/UserDAO.php';

class UserEdit extends View {

    function show() {
        $userId = filter_input(INPUT_GET, 'userId');
        $userDAO = new UserDAO;
        $user = $userDAO->get($userId);
        ?>
        <h2>Users</h2>
        <form id="user" method="post" action="?controller=UserController&action=save">
            <input type="hidden" name="userId" value="<?= $user->getUserId() ?>">
            <label>Username<input name="username" value="<?= $user->getUsername() ?>"></label>   
            <label>Password<input name="password" value="<?= $user->getPassword() ?>"></label>   
            <label>Role<input name="role" value="<?= $user->getRole() ?>"></label>    
        </form>

        <nav>
            <button form="user" type="submit">Save</button>
            <a href="?view=UserList">Ignore</a>
        </nav>
        <?php
    }

}

new UserEdit;