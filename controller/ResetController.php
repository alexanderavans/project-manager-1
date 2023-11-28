<?php

require_once 'framework/Controller.php';
require_once 'framework/SqlProvider.php';

class ResetController extends Controller {

    function run() {
        $db = new SqlProvider;
        $sql = file_get_contents('data/CreateDatabase.sql');
        $db->execute($sql);
        $_SESSION['projectId'] = '';
        $_SESSION['userId'] = '';
        return 'view=Home';
    }

}

new ResetController;
