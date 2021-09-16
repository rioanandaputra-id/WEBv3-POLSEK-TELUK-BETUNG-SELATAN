<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="float-left">
                                <h1 class="h5 text-gray-800">MENU INFORMASI NOMOR DARURAT</h1>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" onclick="modal_save()">TAMBAH <i class="fas fa-plus-circle"></i></button>
                                <button class="btn btn-sm btn-danger" onclick="select_delete()">HAPUS <i class="fas fa-trash-alt"></i></button>
                                <button class="btn btn-sm btn-info" onclick="select_publish(0)">ARSIPKAN <i class="fas fa-times-circle"></i></button>
                                <button class="btn btn-sm btn-success" onclick="select_publish(1)">PUBLIKASIKAN <i class="fas fa-check-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <select id="publish" class="form-control">
                        <option value="1">== DIPUBLIKASIKAN ==</option>
                        <option value="0">== DIARSIPKAN ==</option>
                    </select>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Instansi</th>
                                <th style="max-width: 300px;">Kontak</th>
                                <th style="max-width: 200px;" class="desktop">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                <form method='post' action='' id="modal-upload">
                    <div class="row mb-2">
                        <div class="col">
                            <label>Instansi: <strong><i class="text-danger">*</i></strong></label>
                            <input type="hidden" class="form-control" name="ID" id="ID">
                            <input type="text" class="form-control" name="INSTANSI" id="INSTANSI">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>Telpon: <strong><i class="text-danger">*</i></strong></label>
                            <input type="number" class="form-control" name="TLP" id="TLP">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label>WhatsApp: </label>
                            <input type="number" class="form-control" name="WA" id="WA">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label><strong>Status: <i class="text-danger">*</i></strong></label>
                            <select id="MPUBLISH" name="PUBLISH" class="form-control">
                                <option value="">== PILIH ==</option>
                                <option value="1">DIPUBLIKASIKAN</option>
                                <option value="0">DIARSIPKAN</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_save" onclick="btn_save()">Tambah</button>
                <button type="button" class="btn btn-primary" id="btn_update" onclick="btn_update()">Ubah</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/css/datatables.min.css'); ?>" />
<script type="text/javascript" src="<?= base_url('assets/backend/js/datatables.min.js'); ?>"></script>
<link type="text/css" href="<?= base_url('assets/backend/css/dataTables.checkboxes.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url('assets/backend/js/dataTables.checkboxes.min.js'); ?>"></script>
<script src="<?= base_url('/assets/backend/js/sweetalert2@11.js'); ?>"></script>


<script type="text/javascript">
    function modal_save() {
        $('#modal-upload')[0].reset();
        $('#btn_update').hide();
        $('#btn_save').show();
        $('#modal-title').text("Tambah Nomor Darurat");
        $('#exampleModal').modal('show');
    }

    function modal_update(params) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/nomor_edit/') ?>",
            data: {
                id: params
            },
            dataType: "JSON",
            success: function(data) {
                $('#ID').val(data.ID);
                $('#INSTANSI').val(data.INSTANSI);
                $('#TLP').val(data.TLP);
                $('#WA').val(data.WA);
                $('#MPUBLISH').val(data.PUBLISH);
                $('#btn_update').show();
                $('#btn_save').hide();
                $('#modal-title').text("Ubah Nomor Darurat");
                $('#exampleModal').modal('show');
            },
            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            }
        });
    }

    function btn_save() {
        var formData = new FormData($("#modal-upload")[0]);
        $.ajax({
            url: "<?= base_url('admin/nomor_save/'); ?>",
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
                    Swal.fire(
                        'Berhasil!',
                        data.msg,
                        'success'
                    ).then((result) => {
                        $('#exampleModal').modal('hide');
                        table.ajax.reload();
                    });
                }
            },
            error: function(returndata) {
                alert(returndata);
            }
        });
    }

    function btn_update() {
        var formData = new FormData($("#modal-upload")[0]);
        $.ajax({
            url: "<?= base_url('admin/nomor_update/'); ?>",
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
                    Swal.fire(
                        'Berhasil!',
                        data.msg,
                        'success'
                    ).then((result) => {
                        $('#exampleModal').modal('hide');
                        table.ajax.reload();
                    });
                }
            },
            error: function(returndata) {
                alert(returndata);
            }
        });
    }

    var table;
    $(document).ready(function() {
        $('#publish').on('change', function() {
            table.ajax.reload();
        });
        table = $('#dataTable').DataTable({
            "language": {
                "processing": "Sedang proses...",
                "lengthMenu": "Tampilan _MENU_ entri",
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "info": "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Tampilan 0 hingga 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "search": "Cari:",
                "paginate": {
                    "first": "Awal",
                    "previous": "Balik",
                    "next": "Lanjut",
                    "last": "Akhir"
                }
            },
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('admin/nomor_ajax/'); ?>",
                "type": "POST",
                "data": {
                    "publish": function() {
                        return $('#publish').val()
                    }
                }
            },
            'columnDefs': [{
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true,
                        'stateSave': false
                    }
                },
                {
                    "targets": [3],
                    "orderable": false
                }
            ],
            'stateSave': true,
            'select': {
                'style': 'multi'
            },
        });
    });

    function select_delete() {
        var rows_selected = table.column(0).checkboxes.selected();
        var data = [];
        $.each(rows_selected, function(index, rowId) {
            data.push(rowId);
        });
        delete_informasi(data);
        data = [];
    }

    function select_publish(type) {
        var rows_selected = table.column(0).checkboxes.selected();
        var data = [];
        $.each(rows_selected, function(index, rowId) {
            data.push(rowId);
        });
        publish_informasi(type, data);
        data = [];
    }

    function delete_informasi(data) {
        Swal.fire({
            title: 'Apa kamu yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak, batal!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('admin/nomor_delete/') ?>",
                    data: {
                        data: data
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data == true) {
                            Swal.fire(
                                'Berhasil!',
                                'Data telah dihapus.',
                                'success'
                            )
                            table.ajax.reload();
                        }
                        if (data == false) {
                            Swal.fire(
                                'Pilih data terlebih dulu!',
                                'Untuk Dihapus',
                                'error'
                            )
                            table.ajax.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }
        })
    }

    function publish_informasi(type, data) {
        var text;
        if (type == 1) {
            text = "Publikasikan";
        } else {
            text = "Arsipkan";
        }
        Swal.fire({
            title: 'Apa kamu yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya! ' + text,
            cancelButtonText: 'Tidak! Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('admin/nomor_publish/') ?>",
                    data: {
                        publish: type,
                        id: data
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data == true) {
                            Swal.fire(
                                'Berhasil!',
                                text + ' Data',
                                'success'
                            )
                            table.ajax.reload();
                        }
                        if (data == false) {
                            Swal.fire(
                                'Pilih data terlebih dulu!',
                                'Untuk ' + text + ' Data',
                                'error'
                            )
                            table.ajax.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }
        });
    }
</script>