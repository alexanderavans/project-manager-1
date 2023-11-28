<?php

require_once 'framework/DAO.php';
require_once 'model/Project.php';

class ProjectDAO extends DAO {

    private static $select = 'SELECT * FROM `TM1_Project`';

    function __construct() {
        parent::__construct('Project');
    }

    function startList(): void {
        $sql = self::$select;
        $sql .= ' ORDER BY `TM1_Project`.`projectId`';
        $this->startListSql($sql);
    }

    function get(?string $projectId) {
        if (empty($projectId)) {
            return new Project;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `TM1_Project`.`projectId` = ?';
            return $this->getObjectSql($sql, [$projectId]);
        }
    }

    function delete(int $projectId) {
        $sql = 'DELETE FROM `TM1_Project` '
                . ' WHERE `projectId` = ?';
        $args = [
            $projectId
        ];
        $this->execute($sql, $args);
    }

    private function insert(Project $project) {
        $sql = 'INSERT INTO `TM1_Project` '
                . ' (title, description, owner, status)'
                . ' VALUES (?, ?, ?, ?)';
        $args = [
            $project->getTitle(),
            $project->getDescription(),
            $project->getOwner(),
            $project->getStatus(),
        ];
        $this->execute($sql, $args);
    }

    private function update(Project $project) {
        $sql = 'UPDATE `TM1_Project` '
                . ' SET title = ?, description = ?, owner = ?, status = ? '
                . ' WHERE projectId = ?';
        $args = [
            $project->getTitle(),
            $project->getDescription(),
            $project->getOwner(),
            $project->getStatus(),
            $project->getProjectId()
        ];
        $this->execute($sql, $args);
    }

    function save(Project $project) {
        if (empty($project->getProjectId())) {
            $this->insert($project);
        } else {
            $this->update($project);
        }
    }

}
