<form id="formUpdateUsers">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Update User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-12">
                <label for="inputEmailAddress" class="form-label">Username</label>
                <input type="hidden" class="form-control" id="inputEmailAddress" name="id" value="<?= $user['id'] ?>">
                <input type="text" class="form-control" id="inputEmailAddress" name="username" placeholder="Enter Username" value="<?= $user['username'] ?>" readonly>
            </div>
            <div class="col-12">
                <label for="inputEmailAddress" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputEmailAddress" name="name" placeholder="Enter Fullname" value="<?= $user['name'] ?>">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>