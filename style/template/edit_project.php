<div class="modal fade" id="projectEdit<?php echo $id_project; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editProjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="projectForm" class="modal-content" action="config/aksi_edit_project.php" method="post" >
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectLabel">Edit Project</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_project" value="<?php echo $id_project; ?>">

                <div class="mb-4">
                    <label for="projectName" class="form-label">Project Name</label>
                    <input type="text" class="form-control" id="projectName" name="projectName"
                        placeholder="Enter project name" required  aria-describedby="nameHelp"
                        autocomplete="off" value="<?php echo htmlspecialchars($name_project); ?>"/>
                    <div id="nameHelp" class="form-text">Give your project a clear and concise name.</div>
                </div>

                <div class="mb-4">
                    <label for="projectDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="projectDescription" name="projectDescription" rows="4"
                        placeholder="Enter project description" required 
                        aria-describedby="descHelp"><?php echo htmlspecialchars($desc_project); ?></textarea>
                    <div id="descHelp" class="form-text">Describe the purpose and scope of this project.</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" aria-label="Save project">Update Project</button>
            </div>
        </form>
    </div>
</div>