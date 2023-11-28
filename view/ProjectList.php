<?php
require_once 'framework/View.php';
require_once 'model/Project.php';
require_once 'dao/ProjectDAO.php';

class ProjectList extends View {

    function show() {
        $projectDAO = new ProjectDAO;
        $projectDAO->startList();
        ?>
        <h2>Projects</h2>

        <nav>
            <a href="?view=ProjectEdit">Add project</a>
        </nav>

        <table>
            <tr>
                <th></th>
                <th></th>
                <th>Project</th>
                <th>Description</th>
                <th>Owner</th>
                <th>Status</th>
            </tr>
            <?php
            while ($projectDAO->hasNext()) {
                $project = $projectDAO->getNext();
                ?>
                <tr onclick="">
                    <td><a href="?view=ProjectEdit&projectId=<?= $project->getProjectId() ?>">edit</a></td>
                    <td><a href="?controller=ProjectController&action=delete&projectId=<?= $project->getProjectId() ?>">delete</a></td>
                    <td><?= $project->getTitle() ?></td>
                    <td><?= $project->getDescription() ?></td>
                    <td><?= $project->getOwner() ?></td>
                    <td><?= $project->getStatus() ?></td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php
    }

}
new ProjectList;

        

