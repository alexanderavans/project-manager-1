<?php

require_once 'framework/Model.php';

class Project extends Model
{

    protected $projectId = null;
    protected $title = '';
    protected $description = '';
    protected $owner = '';
    protected $status = '';

    /**
     * create new Project from form or database
     * see Model constructor for explanation
     * @param array|null $data
     */
    function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    function getProjectId()
    {
        return $this->projectId;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getOwner()
    {
        return $this->owner;
    }

    function getStatus()
    {
        return $this->status;
    }

}