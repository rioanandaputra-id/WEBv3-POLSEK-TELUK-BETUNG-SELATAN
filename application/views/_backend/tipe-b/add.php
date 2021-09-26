<link href="<?= base_url('assets/backend/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('assets/backend/summernote/summernote-lite.min.js'); ?>"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>MENU TAMBAH LAPORAN TIPE B</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formtipeb" method="POST" onsubmit="return false">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label>Nomor Laporan:</label>
                                        <input type="text" class="form-control" value="LP/B/" disabled>
                                    </div>
                                    <div class="col">
                                        <label>.</label>
                                        <input type="number" name="no" class="form-control" value="<?= $no_lap[0]->NO_LAP + 1; ?>">
                                    </div>
                                    <div class="col">
                                        <label>.</label>
                                        <input type="text" class="form-control" value="/<?= getRomawi(date('n')) ?>/<?= date('Y') ?>/RESTA BALAM/SEKTOR TBS" disabled>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>1. YANG MELAPORKAN</strong></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Nama Pelapor:</label>
                                                <input type="text" name="a" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label>Tempat Lahir Pelapor:</label>
                                                <input type="text" name="b" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Tanggal Lahir Pelapor:</label>
                                                <input type="date" name="c" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label>Jenis Kelamin Pelapor:</label>
                                                <select class="form-control" name="d">
                                                    <option>==Pilih==</option>
                                                    <option value="Pria">Pria</option>
                                                    <option value="Wanita">Wanita</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Pekerjaan Pelapor:</label>
                                                <input type="text" name="e" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label>Agama Pelapor:</label>
                                                <select class="form-control" name="f">
                                                    <option>==Pilih==</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Katholik">Katholik</option>
                                                    <option value="Protestan">Protestan</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Budha">Budha</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Telpon Pelapor:</label>
                                                <input type="number" name="g" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label>Email Pelapor:</label>
                                                <input type="email" name="h" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Alamat Pelapor:</label>
                                                <input type="text" name="i" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>2. PERISTIWA YANG DILAPORKAN</strong></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Waktu Kejadian:</label>
                                                <input type="datetime-local" name="j" class="form-control" id="j2">
                                            </div>
                                            <div class="col">
                                                <label>Tempat Kejadian:</label>
                                                <input type="text" name="k" class="form-control" id="k2">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Apa Yang Terjadi:</label>
                                                <input type="text" name="l" class="form-control" id="l2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>A. KORBAN</strong> <button onclick="addslota();" class="btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button> <button onclick="delslota();" class="btn btn-sm btn-light"><i class="fas fa-minus-circle"></i></button></h1>
                                        <input type="hidden" id="counta" value="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Nama Korban ke-1: ( <strong><input id="cka" type="checkbox" data-toggle="toggle"> Pelapor</strong> )</label>
                                        <input id="l" type="text" name="m[0]" class="ipa form-control">
                                    </div>
                                    <div class="col">
                                        <label>Tempat Lahir Korban ke-1:</label>
                                        <input type="text" name="n[0]" class="ipa form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal Lahir Korban ke-1:</label>
                                        <input type="date" name="o[0]" class="ipa form-control">
                                    </div>
                                    <div class="col">
                                        <label>Jenis Kelamin Korban ke-1:</label>
                                        <select name="p[0]" class="ipa form-control">
                                            <option value="">==Pilih==</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Alamat Korban ke-1:</label>
                                        <input type="text" name="q[0]" class="ipa form-control">
                                    </div>
                                </div>
                                <div id="slota"></div>
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>B. TERLAPOR</strong> <button onclick="addslotb();" class="disb btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button><button onclick="delslotb();" class="disb btn btn-sm btn-light"><i class="fas fa-minus-circle"></i></button></h1>
                                        <input type="hidden" id="countb" value="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Nama Terlapor ke-1: ( <strong><input id="ckb" type="checkbox" data-toggle="toggle"> Lidik</strong> )</label>
                                        <input id="r" type="text" name="r[0]" class="ipb form-control">
                                    </div>
                                    <div class="col">
                                        <label>Tempat Lahir Terlapor ke-1:</label>
                                        <input type="text" name="s[0]" class="ipb form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal Lahir Terlapor ke-1:</label>
                                        <input type="date" name="t[0]" class="ipb form-control">
                                    </div>
                                    <div class="col">
                                        <label>Jenis Kelamin Terlapor ke-1:</label>
                                        <select name="u[0]" class="ipb form-control">
                                            <option value="">==Pilih==</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Alamat Terlapor ke-1:</label>
                                        <input type="text" name="v[0]" class="ipb form-control">
                                    </div>
                                </div>
                                <div id="slotb"></div>
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>C. SAKSI</strong> <button onclick="addslotc();" class="disc btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button><button onclick="delslotc();" class="disc btn btn-sm btn-light"><i class="fas fa-minus-circle"></i></button></h1>
                                        <input type="hidden" id="countc" value="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Nama Saksi ke-1: ( <strong><input id="ckc" type="checkbox" data-toggle="toggle"> Tidak Ada</strong> )</label>
                                        <input id="w" type="text" name="w[0]" class="ipc form-control">
                                    </div>
                                    <div class="col">
                                        <label>Tempat Lahir Saksi ke-1:</label>
                                        <input type="text" name="x[0]" class="ipc form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal Lahir Saksi ke-1:</label>
                                        <input type="date" name="y[0]" class="ipc form-control">
                                    </div>
                                    <div class="col">
                                        <label>Jenis Kelamin Saksi ke-1:</label>
                                        <select name="z[0]" class="ipc form-control">
                                            <option value="">==Pilih==</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Alamat Saksi ke-1:</label>
                                        <input type="text" name="aa[0]" class="ipc form-control">
                                    </div>
                                </div>
                                <div id="slotc"></div>
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>3. URAIAN KEJADIAN</strong></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <textarea id="bb" name="bb"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>4. CATATAN KEPOLISIAN</strong></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tindakan yang diambil:</label>
                                        <textarea id="cc" name="cc"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tindak Pidana Apa:</label>
                                        <input type="text" name="dd" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Barang Bukti:</label>
                                        <input type="text" name="ee" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" onclick="form_submit()"><strong><i class="fas fa-save"></i> Simpan laporan Tipe B</strong></button>
                                        <button type="reset" class="btn btn-danger"><strong><i class="fas fa-sync"></i> Reset</strong></button>
                                        <button onclick="window.history.back();" class="btn btn-secondary"><strong><i class="fas fa-arrow-left"></i> Kembali</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('/assets/backend/js/sweetalert2@11.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('#bb').summernote({
            height: 200,
            toolbar: [
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
        $('#cc').summernote({
            height: 100,
            toolbar: []
        });
        $('#cka').change(function() {
            if ($(this).is(":checked")) {
                $('#l').val('PELAPOR');
                $('.ipa').prop('disabled', true);
            } else {
                $('#l').val('');
                $('.ipa').prop('disabled', false);
            }
        });
        $('#ckb').change(function() {
            if ($(this).is(":checked")) {
                $('#r').val('LIDIK');
                $('.ipb').prop('disabled', true);
                $('.disb').prop('disabled', true);
                $('.rmckb').remove();
                $('#countb').val('1');
            } else {
                $('#r').val('');
                $('.ipb').prop('disabled', false);
                $('.disb').prop('disabled', false);
            }
        });
        $('#ckc').change(function() {
            if ($(this).is(":checked")) {
                $('#w').val('-');
                $('.ipc').prop('disabled', true);
                $('.disc').prop('disabled', true);
                $('.rmckc').remove();
                $('#countc').val('1');
            } else {
                $('#w').val('');
                $('.ipc').prop('disabled', false);
                $('.disc').prop('disabled', false);
            }
        });
        $('#cc').summernote('code', '<ol type="a"><li></li><li></li><li></li></ol>');
        var j2 = "#####",
            k2 = "#####",
            l2 = "#####";
        $("#j2").change(function(event) {
            var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
            namahari = namahari.split(" ");
            var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
            namabulan = namabulan.split(" ");
            var tgl = new Date($(this).val());
            var hari = tgl.getDay();
            var tanggal = tgl.getDate();
            var bulan = tgl.getMonth();
            var tahun = tgl.getFullYear();
            var hour = tgl.getHours();
            var minutes = tgl.getMinutes();
            j2 = "Pada hari " + namahari[hari] + ", tanggal " + tanggal + " " + namabulan[bulan] + " " + tahun + " sekira pukul " + hour + ":" + minutes + " WIB";
            $('#bb').summernote('code', '<p>----- ' + j2 + ' di ' + k2 + ' <strong>telah terjadi tindak pidana ' + l2 + '</strong> -----</p><p>----- Kronologis Kejadian ##### -----</p><p>----- <strong>Atas kejadian tersebut saya laporkan ke Polsek Teluk Betung Selatan guna Pengusutan Lebih Lanjut</strong> -----</p>');
        });
        $("#k2").keyup(function(event) {
            k2 = $(this).val();
            $('#bb').summernote('code', '<p>----- ' + j2 + ' di ' + k2 + ' <strong>telah terjadi tindak pidana ' + l2 + '</strong> -----</p><p>----- Kronologis Kejadian ##### -----</p><p>----- <strong>Atas kejadian tersebut saya laporkan ke Polsek Teluk Betung Selatan guna Pengusutan Lebih Lanjut</strong> -----</p>');
        });
        $("#l2").keyup(function(event) {
            l2 = $(this).val();
            $('#bb').summernote('code', '<p>----- ' + j2 + ' di ' + k2 + ' <strong>telah terjadi tindak pidana ' + l2 + '</strong> -----</p><p>----- Kronologis Kejadian ##### -----</p><p>----- <strong>Atas kejadian tersebut saya laporkan ke Polsek Teluk Betung Selatan guna Pengusutan Lebih Lanjut</strong> -----</p>');
        });
    });

    function addslota() {
        var count;
        $('#counta').val(function(i, oldval) {
            count = ++oldval
            return count;
        })
        $('#slota').append(`<div id="seca` + count + `"> <div class="row mt-2">
                                    <div class="col">
                                        <label>Nama Korban ke-` + count + `:</label>
                                        <input type="text" name="m[` + (count - 1) + `]" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label>Tempat Lahir Korban ke-` + count + `:</label>
                                        <input type="text" name="n[` + (count - 1) + `]" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal Lahir Korban ke-` + count + `:</label>
                                        <input type="date" name="o[` + (count - 1) + `]" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label>Jenis Kelamin Korban ke-` + count + `:</label>
                                        <select name="p[` + (count - 1) + `]" class="ipa form-control">
                                            <option value="">==Pilih==</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Alamat Korban ke-` + count + `:</label>
                                        <input type="text" name="q[` + (count - 1) + `]" class="form-control">
                                    </div>
                                </div>`);
    }

    function addslotb() {
        var count;
        $('#countb').val(function(i, oldval) {
            count = ++oldval
            return count;
        })
        $('#slotb').append(`<div class="rmckb" id="secb` + count + `"><div class="row mt-2">
                                    <div class="col">
                                        <label>Nama Terlapor ke-` + count + `:</label>
                                        <input id="x" type="text" name="r[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                    <div class="col">
                                        <label>Tempat Lahir Terlapor ke-` + count + `:</label>
                                        <input type="text" name="s[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal Lahir Terlapor ke-` + count + `:</label>
                                        <input type="date" name="t[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                    <div class="col">
                                        <label>Jenis Kelamin Terlapor ke-` + count + `:</label>
                                        <select name="p[` + (count - 1) + `]" class="ipa form-control">
                                            <option value="">==Pilih==</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Alamat Terlapor ke-` + count + `:</label>
                                        <input type="text" name="v[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                </div>
                                </div>`);
    }

    function addslotc() {
        var count;
        $('#countc').val(function(i, oldval) {
            count = ++oldval
            return count;
        })
        $('#slotc').append(`<div class="rmckc" id="secc` + count + `"><div class="row mt-2">
                                    <div class="col">
                                        <label>Nama Saksi ke-` + count + `:</label>
                                        <input id="x" type="text" name="w[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                    <div class="col">
                                        <label>Tempat Lahir Saksi ke-` + count + `:</label>
                                        <input type="text" name="x[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tanggal Lahir Saksi ke-` + count + `:</label>
                                        <input type="date" name="y[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                    <div class="col">
                                        <label>Jenis Kelamin Saksi ke-` + count + `:</label>
                                        <select name="z[` + (count - 1) + `]" class="ipa form-control">
                                            <option value="">==Pilih==</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Alamat Saksi ke-` + count + `:</label>
                                        <input type="text" name="aa[` + (count - 1) + `]" class="ipc form-control">
                                    </div>
                                </div>
                                </div>`);
    }

    function delslota() {
        $('#seca' + $('#counta').val()).remove();
        if ($('#counta').val() != 1) {
            $('#counta').val(function(i, oldval) {
                return --oldval;
            });
        }
    }

    function delslotb() {
        $('#secb' + $('#countb').val()).remove();
        if ($('#countb').val() != 1) {
            $('#countb').val(function(i, oldval) {
                return --oldval;
            });
        }
    }

    function delslotc() {
        $('#secc' + $('#countc').val()).remove();
        if ($('#countc').val() != 1) {
            $('#countc').val(function(i, oldval) {
                return --oldval;
            });
        }
    }

    function form_submit() {
        var formData = new FormData($("#formtipeb")[0]);
        $.ajax({
            url: "<?= base_url('admin/tipeb_save/'); ?>",
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
                            window.location.href = "<?= base_url('admin/laporan/tipeb'); ?>";
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