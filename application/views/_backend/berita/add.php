<link href="<?= base_url('assets/backend/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('assets/backend/summernote/summernote-lite.min.js'); ?>"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>MENU INFORMASI TAMBAH BERITA</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form id="test" enctype="multipart/form-data" method="POST" onsubmit="return false">
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label><strong>Gambar Utama: <i class="text-danger">*</i></strong></label>
                                        <img id="image-preview" src="<?= base_url('assets/backend/img/noimage.png'); ?>" width="140" height="120" onclick="show_modal()">
                                        <input type="hidden" name="path" id="path" value="<?= time() . uniqid(); ?>">
                                        <input type="hidden" name="url_thumbnail" id="url_thumbnail">
                                        <input type="hidden" name="tipe_thumbnail" id="tipe_thumbnail">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label><strong>Judul Berita: <i class="text-danger">*</i></strong></label>
                                                <input type="text" class="form-control" name="judul">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label><strong>Tanggal Berita: <i class="text-danger">*</i></strong></label>
                                                <input type="date" class="form-control" name="tgl">
                                            </div>
                                            <div class="col">
                                                <label><strong>Status Berita: <i class="text-danger">*</i></strong></label>
                                                <select name="publish" class="form-control">
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
                                        <label><strong>Isi Berita: <i class="text-danger">*</i></strong></label>
                                        <textarea id="isi" name="isi"></textarea>
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
                                <label><strong>Upload</strong></label>
                                <input type="file" accept="image/*" class="form-control" name="unggah" id="modal_unggah">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_unggah_img" onclick="btn_unggah_img()">Insert Image</button>
                <button type="button" class="btn btn-primary" id="btn_unggah_doc" onclick="btn_unggah_doc()">Insert Document</button>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('/assets/backend/js/sweetalert2@11.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('#isi').summernote({
            height: 400,
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                },
                onMediaDelete: function(target) {
                    deleteImage(target[0].src);
                }
            },
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['dokumen', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
            ],
            buttons: {
                dokumen: function(context) {
                    var ui = $.summernote.ui;
                    var button = ui.button({
                        contents: '<i class="fas fa-file-word"/>',
                        tooltip: 'Dokumen',
                        click: function() {
                            $('#hd').hide();
                            $('#btn_unggah_doc').show();
                            $('#btn_unggah_img').hide();
                            $('#modal-title').text("Insert Document");
                            $('#exampleModal').modal('show');
                            $("#btn_unggah_doc").click(function() {
                                if ($('#modal_url').val() == "null" || $('#modal_url').val() == null || $('#modal_url').val() == "") {
                                    return;
                                } else {
                                    var div1 = document.createElement('div');
                                    div1.classList.add('embed-container');
                                    var iframe1 = document.createElement('iframe');
                                    iframe1.setAttribute('src', $('#modal_url').val());
                                    iframe1.setAttribute('frameborder', 0);
                                    iframe1.setAttribute('width', '100%');
                                    iframe1.setAttribute('height', '500px');
                                    iframe1.setAttribute('allowfullscreen', true);
                                    div1.appendChild(iframe1);
                                    context.invoke('editor.insertNode', div1);
                                    $('#modal_url').val("");
                                }
                                $('#exampleModal').modal('hide');
                            });
                        }
                    });
                    return button.render();
                }
            }
        });
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("unggah", image);
        data.append("folder", $('#path').val());
        $.ajax({
            url: "<?php echo site_url('admin/berita_image_upload') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            dataType: "JSON",
            success: function(res) {
                if (res.type == 'url') {
                    $('#isi').summernote("insertImage", res.url);
                } else {
                    $('#isi').summernote("insertImage", '<?= base_url('assets/upload/berita/') ?>' + res.path + '/' + res.url);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function show_modal() {
        $('#btn_unggah_img').prop('disabled', false);
        $('#btn_unggah_doc').prop('disabled', false);
        $('#btn_unggah_img').html('Insert Image');
        $('#btn_unggah_doc').html('Insert Document');
        $('#hd').show();
        $('#btn_unggah_doc').hide();
        $('#btn_unggah_img').show();
        $('#modal-title').text("Insert Image");
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

    function btn_unggah_img() {
        $('#btn_unggah_img').html('<i class="fa fa-spinner fa-spin fa-fw"></i> Uploading Image..');
        $('#btn_unggah_doc').html('<i class="fa fa-spinner fa-spin fa-fw"></i> Uploading Document..');
        $('#btn_unggah_img').prop('disabled', true);
        $('#btn_unggah_doc').prop('disabled', true);
        if ($('#tipe_thumbnail').val() === 'unggah') {
            deleteImage('<?= base_url('assets/upload/berita/') ?>' + $('#path').val() + '/' + $('#url_thumbnail').val());
        }
        var formData = new FormData($("#modal-upload")[0]);
        formData.append("folder", $('#path').val());
        $.ajax({
            url: "<?php echo site_url('admin/berita_image_upload') ?>",
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
                    $('#image-preview').attr('src', '<?= base_url('assets/upload/berita/') ?>' + res.path + '/' + res.url);
                }
                $('#tipe_thumbnail').attr('value', res.type);
                $('#url_thumbnail').attr('value', res.url);
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
            url: "<?= base_url('admin/berita_save/'); ?>",
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
                            window.location.href = "<?= base_url('admin/informasi/berita'); ?>";
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