    <div class="content-wrapper kanban">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Kanban Board</h1>
                    </div>
                    <div class="col-sm-6 d-none d-sm-block">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kanban Board</li>
                            <!-- modal -->
                            <?php
                            if (isset($_SESSION['level'])) {
                                echo '<a class="btn btn-danger" href="logout.php">Keluar</a>';
                            } else {
                                include("login.php");
                            }

                            ?>
                            <!-- /Modal -->
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content pb-3">
            <div class="container-fluid h-100">

                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Settings
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-light card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Description</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#7</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>

                            </div>
                            <div class="card-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                    Aenean commodo ligula eget dolor. Aenean massa.
                                    Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus.
                                </p>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Create New Task</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#6</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Users</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                                    <label for="customCheckbox1" class="custom-control-label">Bug</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled>
                                    <label for="customCheckbox2" class="custom-control-label">Feature</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                                    <label for="customCheckbox3" class="custom-control-label">Enhancement</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox4" disabled>
                                    <label for="customCheckbox4" class="custom-control-label">Documentation</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox5" disabled>
                                    <label for="customCheckbox5" class="custom-control-label">Examples</label>
                                </div>
                            </div>
                        </div>
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Invite</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#4</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                                    <label for="customCheckbox1_1" class="custom-control-label">Bug Report</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1_2" disabled>
                                    <label for="customCheckbox1_2" class="custom-control-label">Feature Request</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card card-row card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            To Do
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php include("style/template/task_list.php"); ?>
                    </div>
                    <button type="button" class="card card-primary card-outline" data-bs-toggle="modal" data-bs-target="#newTask">
                        <div class="card-header">
                            <h5 class="card-title">Create new task</h5>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </div>
                        </div>
                    </button>
                </div>

                <div class="card card-row card-default">
                    <div class="card-header bg-info">
                        <h3 class="card-title">
                            In Progress
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-light card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Update Readme</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#2</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                    Aenean commodo ligula eget dolor. Aenean massa.
                                    Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-row card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Done
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Create repo</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#1</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>