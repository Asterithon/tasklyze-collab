<div class="modal fade" id="taskUpdate<?php echo $data['id_task']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="taskForm" class="modal-content" action="config/aksi_update_task.php?id=<?php echo $data['id_project'];?>"
            method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskModalLabel">New Task</h5>
            </div>
            <div class="modal-body" id="<?php echo $data['id_task']?>">
                <input type="hidden" name="id_task" value ="<?php echo $data['id_task']?>">
                <div class="mb-4">
                    <label for="taskTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="taskTitle" name="taskTitle"
                        placeholder="Enter task title" required aria-required="true" aria-describedby="titleHelp"
                        autocomplete="off" value="<?php echo $data['name_task']?>" />
                    <div id="titleHelp" class="form-text">Provide a short title for the task.</div>
                </div>
                <div class="mb-4">
                    <label for="taskDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="taskDescription" name="taskDescription" rows="4"
                        placeholder="Enter detailed description" required aria-required="true"
                        aria-describedby="descHelp"><?php echo $data['desc_task']?></textarea>
                    <div id="descHelp" class="form-text">Add helpful details about the task.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                    aria-label="Cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" aria-label="Save task">Update Task</button>
            </div>
        </form>
    </div>
</div>