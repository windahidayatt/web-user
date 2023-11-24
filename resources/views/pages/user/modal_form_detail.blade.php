<div class="modal fade" id="detailUserModal" tabindex="-1" aria-labelledby="detailUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-form">
            <div class="modal-header">
                <h2 class="modal-title" id="detailUserModalLabel">Detail Pengguna</h2>
            </div>
            <form action="#" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="detail_name" name="name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" id="detail_username" name="username" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>No Telp</label>
                                <input type="text" class="form-control" id="detail_phone" name="phone" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" id="detail_address" name="address" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" class="form-control" id="detail_role_name" name="role_name" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary btn-short" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>