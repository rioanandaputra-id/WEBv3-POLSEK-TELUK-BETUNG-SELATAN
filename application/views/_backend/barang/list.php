<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="float-left">
                                <h1 class="h5 text-gray-800">MENU INFORMASI BARANG HILANG</h1>
                            </div>
                            <div class="float-right">
                                <a href="<?= base_url('admin/informasi/barang/tambah'); ?>" class="btn btn-sm btn-primary">TAMBAH <i class="fas fa-plus-circle"></i></a>
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
                        <thead>
                            <tr>
                                <th></th>
                                <th>Foto</th>
                                <th>Barang</th>
                                <th>Ditemukan</th>
                                <th class="none">Keterangan</th>
                                <th class="desktop">Aksi</th>
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

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/css/datatables.min.css'); ?>" />
<script type="text/javascript" src="<?= base_url('assets/backend/js/datatables.min.js'); ?>"></script>
<link type="text/css" href="<?= base_url('assets/backend/css/dataTables.checkboxes.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url('assets/backend/js/dataTables.checkboxes.min.js'); ?>"></script>
<script src="<?= base_url('/assets/backend/js/sweetalert2@11.js'); ?>"></script>


<script type="text/javascript">
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
                "url": "<?php echo site_url('admin/barang_ajax/'); ?>",
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
                    "targets": [1, 3, 5],
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
                    url: "<?= base_url('admin/barang_delete/') ?>",
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
                    url: "<?= base_url('admin/barang_publish/') ?>",
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