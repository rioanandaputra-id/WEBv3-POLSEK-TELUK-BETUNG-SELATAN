<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>MENU INFORMASI TAMBAH TAHANAN</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form id="test" enctype="multipart/form-data" method="POST" onsubmit="return false">
                                <div class="row mb-2">
                                    <div class="col-sm-2">
                                        <label><strong>Foto: <i class="text-danger">*</i></strong></label>
                                        <img id="image-preview" src="<?= base_url('assets/backend/img/noimage.png'); ?>" width="140" height="120" onclick="show_modal()">
                                        <input type="hidden" name="FOTO" id="FOTO">
                                        <input type="hidden" name="TIPE_FOTO" id="TIPE_FOTO">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label><strong>Nama Lengkap: <i class="text-danger">*</i></strong></label>
                                                <input type="text" class="form-control" name="NAMA">
                                            </div>
                                            <div class="col">
                                                <label><strong>Tempat Lahir: <i class="text-danger">*</i></strong></label>
                                                <input type="text" class="form-control" name="TMP_LAHIR">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label><strong>Tanggal Lahir: <i class="text-danger">*</i></strong></label>
                                                <input type="date" class="form-control" name="TGL_LAHIR">
                                            </div>
                                            <div class="col">
                                                <label><strong>Kasus / Perkara: <i class="text-danger">*</i></strong></label>
                                                <input type="text" class="form-control" name="KASUS">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label><strong>Keterangan Tambahan: <i class="text-danger">*</i></strong></label>
                                        <textarea class="form-control" name="KETERANGAN"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label><strong>Tanggal Masuk: <i class="text-danger">*</i></strong></label>
                                        <input type="date" class="form-control" name="CREATE_AT">
                                    </div>
                                    <div class="col">
                                        <label><strong>Ditangani Kesatuan: <i class="text-danger">*</i></strong></label>
                                        <input type="text" class="form-control" name="KESATUAN">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label><strong>Status Data: <i class="text-danger">*</i></strong></label>
                                        <select name="PUBLISH" class="form-control">
                                            <option value="">== PILIH ==</option>
                                            <option value="1">DIPUBLIKASIKAN</option>
                                            <option value="0">DIARSIPKAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <button class="btn btn-primary" type="button" onclick="form_submit(0)"><i class="fas fa-save"></i> Tambahkan</button>
                                        <button class="btn btn-danger" type="button" onclick="window.history.back()"><i class="fa fa-chevron-circle-left"></i> Kembali</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='post' action='' enctype="multipart/form-data" id="modal-upload">
                    <div class="row mb-2">
                        <div class="col">
                            <label><strong>URL</strong></label>
                            <input type="text" class="form-control" name="url" id="modal_url">
                        </div>
                    </div>
                    <div id="hd">
                        <div class="row">
                            <div class="col">
                                <label><strong>Unggah</strong></label>
                                <input type="file" accept="image/*" class="form-control" name="unggah" id="modal_unggah">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_unggah" onclick="btn_unggah()">Unggah</button>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('/assets/backend/js/sweetalert2@11.js'); ?>"></script>
<script>
    function show_modal() {
        $('#modal-title').text("Unggah Foto Tahanan");
        $('#exampleModal').modal('show');
    }

    function deleteImage(src) {
        $.ajax({
            data: {
                src: src
            },
            type: "POST",
            url: "<?php echo site_url('admin/berita_image_delete') ?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }

    function btn_unggah() {
        if ($('#TIPE_FOTO').val() === 'unggah') {
            deleteImage('<?= base_url('assets/upload/tahanan/') ?>' + $('#FOTO').val());
        }
        var formData = new FormData($("#modal-upload")[0]);
        $.ajax({
            url: "<?php echo site_url('admin/tahanan_image_upload') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: "POST",
            dataType: "JSON",
            success: function(res) {
                if (res.type == 'url') {
                    $('#image-preview').attr('src', res.url);
                } else {
                    $('#image-preview').attr('src', '<?= base_url('assets/upload/tahanan/') ?>' + res.url);
                }
                $('#TIPE_FOTO').attr('value', res.type);
                $('#FOTO').attr('value', res.url);
                $('#exampleModal').modal('hide');
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function form_submit() {
        var formData = new FormData($("#test")[0]);
        $.ajax({
            url: "<?= base_url('admin/tahanan_save/'); ?>",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status == 'false') {
                    Swal.fire(
                        'Gagal!',
                        data.msg,
                        'error'
                    );
                } else {
                    Swal.fire({
                        title: data.msg,
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Tidak, Kembali',
                        cancelButtonText: 'Tambahkan Lainnya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('admin/informasi/tahanan'); ?>";
                        } else {
                            location.reload();
                        }
                    });
                }
            },
            error: function(returndata) {
                alert(returndata);
            }
        });
    }
</script>