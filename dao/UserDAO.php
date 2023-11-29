<?php

require_once 'framework/DAO.php';
require_once 'model/User.php';

class UserDAO extends DAO
{

  private static $select = 'SELECT * FROM `TM1_User`';

  function __construct()
  {
    parent::__construct('User');
  }

  function startList(): void
  {
    $sql = self::$select;
    $sql .= ' ORDER BY `TM1_User`.`userId`';
    $this->startListSql($sql);
  }

  function get(?string $userId)
  {
    if (empty($userId)) {
      return new User;
    } else {
      $sql = self::$select;
      $sql .= ' WHERE `TM1_User`.`userId` = ?';
      return $this->getObjectSql($sql, [$userId]);
    }
  }

  function delete(int $userId)
  {
    $sql = 'DELETE FROM `TM1_User` '
      . ' WHERE `userId` = ?';
    $args = [
      $userId
    ];
    $this->execute($sql, $args);
  }

  private function insert(User $user)
  {
    $sql = 'INSERT INTO `TM1_User` '
      . ' (username, password, role)'
      . ' VALUES (?, ?, ?)';
    $args = [
      $user->getUsername(),
      $user->getPassword(),
      $user->getRole(),
    ];
    $this->execute($sql, $args);
  }

  private function update(User $user)
  {
    $sql = 'UPDATE `TM1_User` '
      . ' SET username = ?, password = ?, role = ? '
      . ' WHERE userId = ?';
    $args = [
      $user->getUsername(),
      $user->getPassword(),
      $user->getRole(),
      $user->getUserId(),
    ];
    $this->execute($sql, $args);
  }

  function save(User $user)
  {
    if (empty($user->getUserId())) {
      $this->insert($user);
    } else {
      $this->update($user);
    }
  }

  // Authentication Logic
  function getUserByUsernameAndPassword($username, $password)
  {
    $sql = self::$select;
    $sql .= ' WHERE `TM1_User`.`username` = ?';
    $user = $this->getObjectSql($sql, [$username]);
    if ($user && $password === $user->getPassword()) {
      return $user;
    }

    return null;
  }

  public function login($username, $password)
  {
    $user = $this->getUserByUsernameAndPassword($username, $password);

    if ($user) {
      // Authentication successful
      // Start session and store user information
      //session_start();
      $_SESSION['userId'] = $user->getUserId();
      $_SESSION['username'] = $user->getUsername();
      $_SESSION['role'] = $user->getRole();

      // Return the next location (e.g., dashboard)
      return 'success';
    } else {
      // Authentication failed, return to login page
      return 'error';
    }
  }

  public function logout()
  {
    // End the session
    //session_start();
    session_unset();
    session_destroy();

    // Return the next location (e.g., login page)
    return 'view=Login';
  }
}
