<?php
// Copied from Project.php
require_once 'framework/Model.php';

class User extends Model
{

    protected $userId = null;
    protected $username = '';
    protected $password = '';
    protected $role = '';

    /**
     * create new User from form or database
     * see Model constructor for explanation
     * @param array|null $data
     */
    function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    function getUserId()
    {
        return $this->userId;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getRole()
    {
        return $this->role;
    }

}