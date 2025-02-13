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
                                <button type="button" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#addMenusModal"><i class="bx bxs-plus-square"></i> Add Menus</button>
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
                                <th>Menu Name</th>
                                <th>Menu Order</th>
                                <th>Menu Access Kasir</th>
                            </tr>
                        </thead>
                        <tbody id="show-menus">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="addMenusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAddMenus">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Add Menus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Menu Name</label>
                            <input type="text" class="form-control" id="inputEmailAddress" name="menu_name" placeholder="Enter Menu Name">
                        </div>
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Menu URL</label>
                            <input type="text" class="form-control" id="inputEmailAddress" name="menu_url" placeholder="Enter Menu URL">
                        </div>
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Menu Icon</label>
                            <input type="text" class="form-control" id="inputEmailAddress" name="menu_icon" placeholder="Enter Menu Icon">
                        </div>
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Menu Order</label>
                            <input type="number" class="form-control" id="inputEmailAddress" name="menu_order" placeholder="Enter Menu Order">
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
        getMenus()

        function getMenus() {
            $.ajax({
                type: "GET",
                url: "<?= base_url('getMenus') ?>",
                success: function(data) {
                    $('#show-menus').html(data)
                }
            })
        }
        $('#formAddMenus').submit(function(event) {
            event.preventDefault();
            var form = $(this).serialize()
            $.ajax({
                type: "POST",
                url: "<?= base_url('addMenus') ?>",
                data: form,
                success: function(data) {
                    if (data.status == 'error') {
                        let firstError = Object.values(data.message)[0];
                        round_error_noti(firstError);
                    } else {
                        $('#formAddMenus')[0].reset();
                        $('#addMenusModal').modal('hide')
                        getMenus();
                        round_success_noti(data.message);
                    }
                }
            })
        })
        $('#show-menus').on('click', '#check-access', function() {
            var id = $(this).data('id')
            $.ajax({
                type: 'POST',
                url: '<?= base_url('updateAccess') ?>',
                data: {
                    id: id,
                },
                success: function(data) {
                    if (data.status == 'success') {
                        getMenus();
                        round_success_noti(data.message);
                    } else {
                        round_error_noti(data.message);
                    }
                }
            })
        })
        $('#tableUsers').on('click', '#btn-edit', function() {
            var id = $(this).data('id')
            $.ajax({
                type: 'POST',
                url: '<?= base_url('getFormEdit') ?>',
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#show-form-edit').html(data)
                    $('#editUsersModal').modal('show')
                }
            })
        })
    })
</script>
<?= $this->endSection('script') ?>