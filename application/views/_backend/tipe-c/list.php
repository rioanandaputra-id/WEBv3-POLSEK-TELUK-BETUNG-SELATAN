<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="float-left">
                                <h1 class="h5 text-gray-800">MENU LAPORAN TIPE C</h1>
                            </div>
                            <div class="float-right">
                                <button class="btn btn-sm btn-danger" onclick="select_delete()">HAPUS <i class="fas fa-trash-alt"></i></button>
                                <form action="<?= base_url('doc/tipec'); ?>" method="post" target="_blank" id="printdong">
                                    <input type="text" name="id" id="printid">
                                </form>
                                <button class="btn btn-primary" onclick="select_print()"><strong>Print Laporan</strong> <i class="fas fa-print"></i></button>
                            </div>
                        </div>
                    </div>
                    <select id="STATUS" class="form-control">
                        <option value="BELUM">==BELUM DIPRINT==</option>
                        <option value="SUDAH">SUDAH DIPRINT</option>
                    </select>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Nama Pelapor</th>
                                <th>Kontak Pelapor</th>
                                <th>Alamat Pelapor</th>
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
        $('#STATUS').on('change', function() {
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
                "url": "<?php echo site_url('admin/tipec_ajax/'); ?>",
                "type": "POST",
                "data": {
                    "STATUS": function() {
                        return $('#STATUS').val()
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
                    "targets": [4],
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
        delete_tipec(data);
        data = [];
    }

    function select_print() {
        var rows_selected = table.column(0).checkboxes.selected();
        var data = [];
        $.each(rows_selected, function(index, rowId) {
            data.push(rowId);
        });
        $('#printid').val(data);
        data = [];
        $("#printdong").submit();
    }

    function delete_tipec(data) {
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
                    url: "<?= base_url('admin/tipec_delete/') ?>",
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
</script>