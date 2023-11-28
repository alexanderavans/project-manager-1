<?php

require_once 'framework/SqlProvider.php';

abstract class DAO extends SqlProvider
{

  private $class;
  private $object;
  private $stmt;

  function __construct($class)
  {
    parent::__construct();
    $this->class = $class;
  }

  protected function startListSql($sql, $args = []): void
  {
    $this->stmt = $this->prepare($sql);
    $this->stmt->execute($args);
    $this->object = $this->stmt->fetchObject($this->class) ?: null;
  }

  protected function getObjectSql($sql, $args = []): ?Model
  {
    $this->stmt = $this->prepare($sql);
    $this->stmt->execute($args);
    return $this->stmt->fetchObject($this->class) ?: null;
  }

  function hasNext(): bool
  {
    return $this->object !== null;
  }

  function getNext(): Model
  {
    $result = $this->object;
    $this->object = $this->stmt->fetchObject($this->class) ?: null;
    return $result;
  }
}
