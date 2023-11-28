<?php
require_once 'framework/View.php';
require_once 'dao/ProjectDAO.php';

class ProjectEdit extends View {

    function show() {
        $projectId = filter_input(INPUT_GET, 'projectId');
        $projectDAO = new ProjectDAO;
        $project = $projectDAO->get($projectId);
        ?>
        <h2>Project</h2>
        <form id="project" method="post" action="?controller=ProjectController&action=save">
            <input type="hidden" name="projectId" value="<?= $project->getProjectId() ?>">
            <label>Title<input name="title" value="<?= $project->getTitle() ?>"></label>   
            <label>Owner<input name="owner" value="<?= $project->getOwner() ?>"></label>   
            <label>Description<textarea name="description"><?= $project->getDescription() ?></textarea></label>
            <label>Status<input name="status" value="<?= $project->getStatus() ?>"></label>    
        </form>

        <nav>
            <button form="project" type="submit">Save</button>
            <a href="?view=ProjectList">Ignore</a>
        </nav>
        <?php
    }

}

new ProjectEdit;