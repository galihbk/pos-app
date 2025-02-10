<form id="formUpdatePasswordUsers">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Reset Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-12">
                <label for="inputChoosePassword" class="form-label">Enter New Password</label>
                <input type="hidden" class="form-control" id="inputEmailAddress" name="id" value="<?= $user['id'] ?>">
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