<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>MENU INFORMASI TAMBAH BHABINKAMTIBMAS & KRING SERSE</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form id="test" enctype="multipart/form-data" method="POST" onsubmit="return false">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label><strong>Foto Bhabin: <i class="text-danger">*</i></strong></label>
                                        <img id="image-preview_1" src="<?= base_url('assets/backend/img/noimage.png'); ?>" width="140" height="120" onclick="show_modal(1)">
                                        <input type="hidden" name="FOTO_BHABIN" id="FOTO_BHABIN">
                                        <input type="hidden" name="TIPE_FOTO_BHABIN" id="TIPE_FOTO_BHABIN">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label><strong>Nama Bhabin: <i class="text-danger">*</i></strong></label>
                                                <input type="text" class="form-control" name="NAMA_BHABIN">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label><strong>Telpon Bhabin: <i class="text-danger">*</i></strong></label>
                                                <input type="number" class="form-control" name="TLP_BHABIN" value="62">
                                            </div>
                                            <div class="col">
                                                <label><strong>WhatsApp Bhabin: <i class="text-danger">*</i></strong></label>
                                                <input type="number" class="form-control" name="WA_BHABIN" value="62">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label><strong>Foto Kring Serse: <i class="text-danger">*</i></strong></label>
                                        <img id="image-preview_2" src="<?= base_url('assets/backend/img/noimage.png'); ?>" width="140" height="120" onclick="show_modal(2)">
                                        <input type="hidden" name="FOTO_KRINGSERSE" id="FOTO_KRINGSERSE">
                                        <input type="hidden" name="TIPE_FOTO_KRINGSERSE" id="TIPE_FOTO_KRINGSERSE">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label><strong>Nama Kring Serse: <i class="text-danger">*</i></strong></label>
                                                <input type="text" class="form-control" name="NAMA_KRINGSERSE">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label><strong>Telpon Kring Serse: <i class="text-danger">*</i></strong></label>
                                                <input type="number" class="form-control" name="TLP_KRINGSERSE" value="62">
                                            </div>
                                            <div class="col">
                                                <label><strong>WhatsApp Kring Serse: <i class="text-danger">*</i></strong></label>
                                                <input type="number" class="form-control" name="WA_KRINGSERSE" value="62">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label><strong>Wilayah: <i class="text-danger">*</i></strong></label>
                                                <select name="ID_KELURAHAN" class="form-control">
                                                    <option value="">== PILIH ==</option>
                                                    <?php foreach ($wilayah as $record) : ?>
                                                        <option value="<?= $record->ID_KELURAHAN; ?>"><?= $record->KELURAHAN . ' - ' . $record->KECAMATAN; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label><strong>Status: <i class="text-danger">*</i></strong></label>
                                                <select name="PUBLISH" class="form-control">
                                                    <option value="">== PILIH ==</option>
                                                    <option value="1">DIPUBLIKASIKAN</option>
                                                    <option value="0">DIARSIPKAN</option>
                                                </select>
                                            </div>
                                        </div>
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
                    <div class="row">
                        <div class="col">
                            <label><strong>Unggah</strong></label>
                            <input type="file" accept="image/*" class="form-control" name="unggah" id="modal_unggah">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_unggah_1" onclick="btn_unggah_1()">Unggah</button>
                <button type="button" class="btn btn-primary" id="btn_unggah_2" onclick="btn_unggah_2()">Unggah</button>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('/assets/backend/js/sweetalert2@11.js'); ?>"></script>
<script>
    function show_modal(par) {
        if (par == 1) {
            $('#btn_unggah_1').show();
            $('#btn_unggah_2').hide();
            $('#modal-title').text("Unggah Foto Bhabinkamtibmas");
        } else {
            $('#btn_unggah_1').hide();
            $('#btn_unggah_2').show();
            $('#modal-title').text("unggah Foto Kring Serse");
        }
        $('#exampleModal').modal('show');
    }

    function btn_unggah_1() {
        if ($('#TIPE_FOTO_BHABIN').val() === 'unggah') {
            deleteImage('<?= base_url('assets/upload/bhabin/') ?>' + $('#FOTO_BHABIN').val());
        }
        var formData = new FormData($("#modal-upload")[0]);
        $.ajax({
            url: "<?php echo site_url('admin/bhabin_image_upload') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: "POST",
            dataType: "JSON",
            success: function(res) {
                if (res.type == 'url') {
                    $('#image-preview_1').attr('src', res.url);
                } else {
                    $('#image-preview_1').attr('src', '<?= base_url('assets/upload/bhabin/') ?>' + res.url);
                }
                $('#TIPE_FOTO_BHABIN').attr('value', res.type);
                $('#FOTO_BHABIN').attr('value', res.url);
                $('#exampleModal').modal('hide');
                $("#modal-upload")[0].reset();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function btn_unggah_2() {
        if ($('#TIPE_FOTO_KRINGSERSE').val() === 'unggah') {
            deleteImage('<?= base_url('assets/upload/bhabin/') ?>' + $('#FOTO_KRINGSERSE').val());
        }
        var formData = new FormData($("#modal-upload")[0]);
        $.ajax({
            url: "<?php echo site_url('admin/bhabin_image_upload') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: "POST",
            dataType: "JSON",
            success: function(res) {
                if (res.type == 'url') {
                    $('#image-preview_2').attr('src', res.url);
                } else {
                    $('#image-preview_2').attr('src', '<?= base_url('assets/upload/bhabin/') ?>' + res.url);
                }
                $('#TIPE_FOTO_KRINGSERSE').attr('value', res.type);
                $('#FOTO_KRINGSERSE').attr('value', res.url);
                $('#exampleModal').modal('hide');
                $("#modal-upload")[0].reset();
            },
            error: function(data) {
                console.log(data);
            }
        });
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

    function form_submit() {
        var formData = new FormData($("#test")[0]);
        $.ajax({
            url: "<?= base_url('admin/bhabin_save/'); ?>",
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
                            window.location.href = "<?= base_url('admin/informasi/bhabin'); ?>";
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