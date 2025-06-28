<div class="modal fade" id="taskDelete<?php echo $data['id_task']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="taskForm" class="modal-content" action="config/aksi_delete_task.php?id=<?php echo $data['id_project']; ?>"
            method="post" novalidate>
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskModalLabel">Please confirm to delete the task</h5>
                <input type="hidden" name="id_task" value ="<?php echo $data['id_task']?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    aria-label="Cancel">Cancel</button>
                <button type="submit" class="btn btn-danger" aria-label="Save task">Delete Task</button>
            </div>
        </form>
    </div>
</div>