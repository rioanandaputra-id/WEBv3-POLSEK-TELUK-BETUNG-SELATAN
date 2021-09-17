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
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label>Nomor Laporan:</label>
                                    <input type="text" name="no" class="form-control">
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
                                            <label>Alamat Pelapor:</label>
                                            <input type="text" name="f" class="form-control">
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
                                            <input type="datetime-local" name="i" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Tempat Kejadian:</label>
                                            <input type="text" name="j" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <label>Apa Yang Terjadi:</label>
                                            <input type="text" name="k" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 mb-3">
                                <div class="col">
                                    <h1 class="h5 text-danger"><strong>A. KORBAN</strong> <button class="btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Nama Korban: ( <strong><input id="toggle-event" type="checkbox" data-toggle="toggle"> Pelapor</strong> )</label>
                                    <input type="text" name="l[0]" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Tempat Lahir Korban:</label>
                                    <input type="text" name="m[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Tanggal Lahir Korban:</label>
                                    <input type="text" name="n[0]" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Jenis Kelamin Korban:</label>
                                    <input type="text" name="o[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Alamat Korban:</label>
                                    <input type="text" name="q[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-4 mb-3">
                                <div class="col">
                                    <h1 class="h5 text-danger"><strong>B. TERLAPOR</strong> <button class="btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Nama Terlapor: ( <strong><input id="toggle-event" type="checkbox" data-toggle="toggle"> Lidik</strong> )</label>
                                    <input type="text" name="r[0]" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Tempat Lahir Terlapor:</label>
                                    <input type="text" name="s[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Tanggal Lahir Terlapor:</label>
                                    <input type="text" name="t[0]" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Jenis Kelamin Terlapor:</label>
                                    <input type="text" name="u[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Alamat Terlapor:</label>
                                    <input type="text" name="w[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-4 mb-3">
                                <div class="col">
                                    <h1 class="h5 text-danger"><strong>C. SAKSI</strong> <button class="btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Nama Saksi: ( <strong><input id="toggle-event" type="checkbox" data-toggle="toggle"> Tidak Ada</strong> )</label>
                                    <input type="text" name="x[0]" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Tempat Lahir Saksi:</label>
                                    <input type="text" name="y[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Tanggal Lahir Saksi:</label>
                                    <input type="text" name="z[0]" class="form-control">
                                </div>
                                <div class="col">
                                    <label>Jenis Kelamin Saksi:</label>
                                    <input type="text" name="aa[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Alamat Saksi:</label>
                                    <input type="text" name="cc[0]" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-4 mb-3">
                                <div class="col">
                                    <h1 class="h5 text-danger"><strong>3. URAIAN KEJADIAN</strong></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <textarea id="isi" name="dd"></textarea>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="<?= base_url('/assets/backend/js/sweetalert2@11.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('#isi').summernote({
            height: 200,
            toolbar: [
                ['font', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
        $('#isi').summernote('code', '<p>----- Pada hari ##### tanggal ##### Sekira Jam ##### Wib Di ##### <strong>telah terjadi tindak pidana #####</strong> -----</p><p>----- Kronologis Kejadian ##### -----</p><p>----- <strong>Atas kejadian tersebut saya laporkan ke Polsek Teluk Betung Selatan guna Pengusutan Lebih Lanjut</strong> -----</p>');
    });
    $(function() {
        $('#toggle-event').change(function() {
            $('#console-event').html('Toggle: ' + $(this).prop('checked'))
        })
    });
</script>