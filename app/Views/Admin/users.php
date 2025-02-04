<?= $this->extend('Admin/templates') ?>
<?= $this->section('content') ?>
<div class="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-xl-2">
                                <button type="button" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#addUsersModal"><i class="bx bxs-plus-square"></i> Add User</button>
                            </div>
                            <div class="col-lg-9 col-xl-10">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableUsers">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="addUsersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAddUsers">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputEmailAddress" name="name" placeholder="Enter Fullname">
                        </div>
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputEmailAddress" name="username" placeholder="Enter Username">
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" name="password" id="inputChoosePassword" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        getUser();

        function getUser() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('getUser') ?>',
                success: function(data) {
                    $('#tableUsers').html(data);
                }
            })
        }
        $('#formAddUsers').submit(function(event) {
            event.preventDefault();
            var form = $(this).serialize()
            $.ajax({
                type: "POST",
                url: "<?= base_url('addUser') ?>",
                data: form,
                success: function(data) {
                    if (data.status == 'error') {
                        let firstError = Object.values(data.message)[0];
                        round_error_noti(firstError);
                    } else {
                        $('#formAddUsers')[0].reset();
                        $('#addUsersModal').modal('hide')
                        getUser();
                        round_success_noti(data.message);
                    }
                }
            })
        })
    })
</script>
<?= $this->endSection('script') ?>