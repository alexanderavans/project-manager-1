<?php
//Copied from ProjectList.php
require_once 'framework/View.php';
require_once 'model/User.php';
require_once 'dao/UserDAO.php';

class UserList extends View {

    function show() {
        $userDAO = new UserDAO;
        $userDAO->startList();
        ?>
        <h2>Users</h2>

        <nav>
            <a href="?view=UserEdit">Add user</a>
        </nav>

        <table>
            <tr>
                <th></th>
                <th></th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
            </tr>
            <?php
            while ($userDAO->hasNext()) {
                $user = $userDAO->getNext();
                ?>
                <tr onclick="">
                    <td><a href="?view=UserEdit&userId=<?= $user->getUserId() ?>">edit</a></td>
                    <td><a href="?controller=UserController&action=delete&userId=<?= $user->getUserId() ?>">delete</a></td>
                    <td><?= $user->getUsername() ?></td>
                    <td><?= $user->getPassword() ?></td>
                    <td><?= $user->getRole() ?></td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php
    }

}
new UserList;

        

