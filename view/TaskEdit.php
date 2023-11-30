<?php
require_once 'framework/View.php';
require_once 'dao/TaskDAO.php';
require_once 'view/ProjectSelector.php';

class TaskEdit extends View
{
    function show()
    { // handle get request from browser

        // get parameters from URL
        $action = filter_input(INPUT_GET, 'action');
        $projectId = filter_input(INPUT_GET, 'projectId');
        $taskNumber = filter_input(INPUT_GET, 'taskNumber');

        // create a DAO object
        $taskDAO = new TaskDAO;

        // get a model object from DAO
        $task = $taskDAO->get($projectId, $taskNumber);

        // generate the form
        $ps = new ProjectSelector();
        $projectId = $ps->getProjectId();

        if (empty($projectId)) {
            $projectId = $task->getProjectId();
        }

        // Set variables
        $userRole = $_SESSION['role'] ?? null;
        $userName = $_SESSION['username'] ?? null;
?>
        <h2>Task</h2>
        <form id="task" method="post" action="?controller=TaskController&action=<?= $action ?>">
            <input type="hidden" name="projectId" value="<?= $projectId ?>">
            <input type="hidden" name="taskNumberOrg" value="<?= $task->getTaskNumber() ?>">
            <!--Hieronder staat 2x een echo met if-statement.
            De echo is 1 keer normaal en de andere keer als shorthand
            In de 'echo' staat de volgende shorhand if statement:
                [condition] boolean ? [execute if true] : [execute if false]
            Dus:
                als userRole gelijk is aan medewerker echo dan de attribute readonly in het inputfield.
                als het niet gelijk is aan medewerker echo dan een lege string. Dan wordt er dus niets toegevoegd.-->
            <label>Nummer<input name="taskNumber" value="<?= $task->getTaskNumber() ?>" <?php echo $userRole === 'medewerker' ? 'readonly' : '' ?>></label>
            <label>Title<input name="title" value="<?= $task->getTitle() ?>" <?= $userRole === 'medewerker' ? 'readonly' : '' ?>></label>
            <label>Description<textarea name="description" <?= $userRole === 'medewerker' ? 'readonly' : '' ?>><?= $task->getDescription() ?></textarea></label>

            <?php

            // Voeg 'Status' en 'Worker' kolom toe aan het formulier als de rol niet 'manager' is
            if ($userRole !== 'manager') {
            ?>
                <label>Worker
                    <select name="worker">
                        <option value="" <?= ($task->getWorker() === '') ? 'selected' : '' ?>></option>
                        <option value="<?= $userName ?>" <?= ($task->getWorker() === $userName) ? 'selected' : '' ?>><?= $userName ?></option>';
                        ?>
                    </select>
                </label>
                <label>Status
                    <select name="status">
                        <option value="to do" <?= ($task->getStatus() === 'to do') ? 'selected' : '' ?>>to do</option>
                        <option value="busy" <?= ($task->getStatus() === 'busy') ? 'selected' : '' ?>>busy</option>
                        <option value="done" <?= ($task->getStatus() === 'done') ? 'selected' : '' ?>>done</option>
                    </select>
                </label>
            <?php
            }
            ?>
        </form>

        <nav>
            <button form="task" type="submit">Save</button>
            <a href="?view=TaskList">Ignore</a>
        </nav>
<?php
    }
}

new TaskEdit;
