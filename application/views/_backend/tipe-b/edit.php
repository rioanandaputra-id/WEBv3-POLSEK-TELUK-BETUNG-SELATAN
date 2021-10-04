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

                    <!-- START FORM -->
                    <form id="formtipeb" method="POST" onsubmit="return false">
                        <div class="row">
                            <div class="col">

                                <div class="row">
                                    <div class="col">
                                        <label>Nomor Laporan:</label>
                                        <input type="text" class="form-control" value="LP/B/" readonly>
                                    </div>
                                    <div class="col">
                                        <label>.</label>
                                        <input type="number" name="no" class="form-control" value="<?= $tipeb[0]->NO_LAP; ?>" readonly>
                                    </div>
                                    <div class="col">
                                        <label>.</label>
                                        <input type="text" class="form-control" value="/<?= getRomawi(date('n', strtotime($tipeb[0]->CREATE_AT))) ?>/<?= date('Y', strtotime($tipeb[0]->CREATE_AT)) ?>/RESTA BALAM/SEKTOR TBS" readonly>
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
                                                <input type="hidden" name="id" value="<?= $tipeb[0]->ID_TIPEB; ?>">
                                                <input type="text" name="a" class="form-control" value="<?= $tipeb[0]->NAMA_PELAPOR; ?>">
                                            </div>
                                            <div class="col">
                                                <label>Tempat Lahir Pelapor:</label>
                                                <input type="text" name="b" class="form-control" value="<?= $tipeb[0]->TMPT_LAHIR_PELAPOR; ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Tanggal Lahir Pelapor:</label>
                                                <input type="date" name="c" class="form-control" value="<?= $tipeb[0]->TGL_LAHIR_PELAPOR; ?>">
                                            </div>
                                            <div class="col">
                                                <label>Jenis Kelamin Pelapor:</label>
                                                <select class="form-control" name="d">
                                                    <option>==Pilih==</option>
                                                    <option value="">== PILIH ==</option>
                                                    <option value="Pria" <?= $tipeb[0]->JENKEL_PELAPOR == "Pria" ? 'selected' : ''; ?>>Pria</option>
                                                    <option value="Wanita" <?= $tipeb[0]->JENKEL_PELAPOR == "Wanita" ? 'selected' : ''; ?>>Wanita</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Pekerjaan Pelapor:</label>
                                                <input type="text" name="e" class="form-control" value="<?= $tipeb[0]->PEKERJAAN_PELAPOR; ?>">
                                            </div>
                                            <div class="col">
                                                <label>Agama Pelapor:</label>
                                                <select class="form-control" name="f">
                                                    <option>==Pilih==</option>
                                                    <option value="Islam" <?= $tipeb[0]->AGAMA_PELAPOR == "Islam" ? 'selected' : ''; ?>>Islam</option>
                                                    <option value="Katholik" <?= $tipeb[0]->AGAMA_PELAPOR == "Katholik" ? 'selected' : ''; ?>>Katholik</option>
                                                    <option value="Protestan" <?= $tipeb[0]->AGAMA_PELAPOR == "Protestan" ? 'selected' : ''; ?>>Protestan</option>
                                                    <option value="Hindu" <?= $tipeb[0]->AGAMA_PELAPOR == "Hindu" ? 'selected' : ''; ?>>Hindu</option>
                                                    <option value="Budha" <?= $tipeb[0]->AGAMA_PELAPOR == "Budha" ? 'selected' : ''; ?>>Budha</option>
                                                    <option value="Konghucu" <?= $tipeb[0]->AGAMA_PELAPOR == "Konghucu" ? 'selected' : ''; ?>>Konghucu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Telpon Pelapor:</label>
                                                <input type="number" name="g" class="form-control" value="<?= $tipeb[0]->TLP_PELAPOR; ?>">
                                            </div>
                                            <div class="col">
                                                <label>Email Pelapor:</label>
                                                <input type="email" name="h" class="form-control" value="<?= $tipeb[0]->EMAIL_PELAPOR; ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Alamat Pelapor:</label>
                                                <input type="text" name="i" class="form-control" value="<?= $tipeb[0]->ALAMAT_PELAPOR; ?>">
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
                                                <input type="datetime-local" name="j" class="form-control" id="j2" value="<?= date('Y-m-d\TH:i', strtotime($tipeb[0]->WAKTU_KEJADIAN)); ?>">
                                            </div>
                                            <div class="col">
                                                <label>Tempat Kejadian:</label>
                                                <input type="text" name="k" class="form-control" id="k2" value="<?= $tipeb[0]->TMPT_KEJADIAN; ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <label>Apa Yang Terjadi:</label>
                                                <input type="text" name="l" class="form-control" id="l2" value="<?= $tipeb[0]->YG_TERJADI; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- START KORBAN -->
                                <div class="row mt-5 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>A. SIAPA KORBAN ?</strong> <button onclick="addslota();" class="btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button> <button onclick="delslota();" class="btn btn-sm btn-light"><i class="fas fa-minus-circle"></i></button></h1>
                                        <strong> (<input id="cka" name="cka" type="checkbox" <?= $tipeb[0]->CK_KORBAN == 1 ? 'checked' : ''; ?>> <i>Ceklis Jika Korban Adalah Pelapor</i></strong>)
                                    </div>
                                </div>
                                <?php
                                $CI = &get_instance();
                                $CI->load->model('backend/tipeb_model');
                                $result = $CI->tipeb->getdet(array("ID_TIPEB" => $tipeb[0]->ID_TIPEB, "KET" => "Korban"));
                                if ($CI->db->affected_rows() > 0) :
                                    $i = 1;
                                    foreach ($result as $record1) : ?>
                                        <div id="seca<?= $i; ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <label>Nama Korban ke-<?= $i; ?>:</label>
                                                    <input type="text" name="m[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->NAMA; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Tempat Lahir Korban ke-<?= $i; ?>:</label>
                                                    <input type="text" name="n[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->TMPT_LAHIR; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Tanggal Lahir Korban ke-<?= $i; ?>:</label>
                                                    <input type="date" name="o[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->TGL_LAHIR; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Jenis Kelamin Korban ke-<?= $i; ?>:</label>
                                                    <select name="p[<?= ($i - 1); ?>]" class="form-control">
                                                        <option value="">==Pilih==</option>
                                                        <option value="Pria" <?= $record1->JENKEL == "Pria" ? 'selected' : ''; ?>>Pria</option>
                                                        <option value="Wanita" <?= $record1->JENKEL == "Wanita" ? 'selected' : ''; ?>>Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Alamat Korban ke-<?= $i; ?>:</label>
                                                    <input type="text" name="q[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->ALAMAT; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++;
                                    endforeach; ?>
                                    <input type="hidden" id="counta" value="<?= ($i - 1); ?>">
                                <?php else : ?>
                                    <input type="hidden" id="counta" value="0">
                                <?php endif; ?>
                                <div id="slota"></div>
                                <!-- END KORBAN -->
                                <!-- START TERLAPOR -->
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>B. SIAPA TERLAPOR ?</strong> <button onclick="addslotb();" class="disb btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button><button onclick="delslotb();" class="disb btn btn-sm btn-light"><i class="fas fa-minus-circle"></i></button></h1>
                                        <strong> (<input id="ckb" name="ckb" type="checkbox" <?= $tipeb[0]->CK_TERLAPOR == 1 ? 'checked' : ''; ?>> <i>Ceklis Jika Terlapor Adalah Lidik</i></strong>)
                                    </div>
                                </div>
                                <?php
                                $CI = &get_instance();
                                $CI->load->model('backend/tipeb_model');
                                $result = $CI->tipeb->getdet(array("ID_TIPEB" => $tipeb[0]->ID_TIPEB, "KET" => "Terlapor"));
                                if ($CI->db->affected_rows() > 0) :
                                    $i = 1;
                                    foreach ($result as $record1) : ?>
                                        <div class="rmckb" id="secb<?= $i; ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <label>Nama Terlapor ke-<?= $i; ?>:</label>
                                                    <input type="text" name="r[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->NAMA; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Tempat Lahir Terlapor ke-<?= $i; ?>:</label>
                                                    <input type="text" name="s[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->TMPT_LAHIR; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Tanggal Lahir Terlapor ke-<?= $i; ?>:</label>
                                                    <input type="date" name="t[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->TGL_LAHIR; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Jenis Kelamin Terlapor ke-<?= $i; ?>:</label>
                                                    <select name="u[<?= ($i - 1); ?>]" class="form-control">
                                                        <option value="">==Pilih==</option>
                                                        <option value="Pria" <?= $record1->JENKEL == "Pria" ? 'selected' : ''; ?>>Pria</option>
                                                        <option value="Wanita" <?= $record1->JENKEL == "Wanita" ? 'selected' : ''; ?>>Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Alamat Terlapor ke-<?= $i; ?>:</label>
                                                    <input type="text" name="v[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->ALAMAT; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++;
                                    endforeach; ?>
                                    <input type="hidden" id="countb" value="<?= ($i - 1); ?>">
                                <?php else : ?>
                                    <input type="hidden" id="countb" value="0">
                                <?php endif; ?>
                                <div id="slotb"></div>
                                <!-- END TERLAPOR -->
                                <!-- START SAKSI -->
                                <div class="row mt-4 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>C. SIAPA SAKSI ?</strong> <button onclick="addslotc();" class="disc btn btn-sm btn-light"><i class="fas fa-plus-circle"></i></button><button onclick="delslotc();" class="disc btn btn-sm btn-light"><i class="fas fa-minus-circle"></i></button></h1>
                                        <strong> (<input id="ckc" name="ckc" type="checkbox" <?= $tipeb[0]->CK_SAKSI == 1 ? 'checked' : ''; ?>> <i>Ceklis Jika Saksi Tidak Ada</i></strong>)
                                    </div>
                                </div>
                                <?php
                                $CI = &get_instance();
                                $CI->load->model('backend/tipeb_model');
                                $result = $CI->tipeb->getdet(array("ID_TIPEB" => $tipeb[0]->ID_TIPEB, "KET" => "Saksi"));
                                if ($CI->db->affected_rows() > 0) :
                                    $i = 1;
                                    foreach ($result as $record1) : ?>
                                        <div class="rmckc" id="secc<?= $i; ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <label>Nama Saksi ke-<?= $i; ?>:</label>
                                                    <input type="text" name="w[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->NAMA; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Tempat Lahir Saksi ke-<?= $i; ?>:</label>
                                                    <input type="text" name="x[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->TMPT_LAHIR; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Tanggal Lahir Saksi ke-<?= $i; ?>:</label>
                                                    <input type="date" name="y[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->TGL_LAHIR; ?>">
                                                </div>
                                                <div class="col">
                                                    <label>Jenis Kelamin Saksi ke-<?= $i; ?>:</label>
                                                    <select name="z[<?= ($i - 1); ?>]" class="form-control">
                                                        <option value="">==Pilih==</option>
                                                        <option value="Pria" <?= $record1->JENKEL == "Pria" ? 'selected' : ''; ?>>Pria</option>
                                                        <option value="Wanita" <?= $record1->JENKEL == "Wanita" ? 'selected' : ''; ?>>Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Alamat Saksi ke-<?= $i; ?>:</label>
                                                    <input type="text" name="aa[<?= ($i - 1); ?>]" class="form-control" value="<?= $record1->ALAMAT; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++;
                                    endforeach; ?>
                                    <input type="hidden" id="countc" value="<?= ($i - 1); ?>">
                                <?php else : ?>
                                    <input type="hidden" id="countc" value="0">
                                <?php endif; ?>
                                <div id="slotc"></div>
                                <!-- END SAKSI -->

                                <div class="row mt-5 mb-3">
                                    <div class="col">
                                        <h1 class="h5 text-danger"><strong>3. URAIAN KEJADIAN</strong></h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <textarea id="bb" name="bb"><?= $tipeb[0]->URAIAN_KEJADIAN; ?></textarea>
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
                                        <textarea id="cc" name="cc"><?= $tipeb[0]->TINDAKAN_DIAMBIL; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Tindak Pidana Apa:</label>
                                        <input type="text" name="dd" class="form-control" value="<?= $tipeb[0]->TINDAK_PIDANA; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Barang Bukti:</label>
                                        <input type="text" name="ee" class="form-control" value="<?= $tipeb[0]->BRG_BUKTI; ?>">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" onclick="form_submit()"><strong><i class="fas fa-save"></i> Ubah laporan Tipe B</strong></button>
                                        <button type="reset" class="btn btn-danger"><strong><i class="fas fa-sync"></i> Reset</strong></button>
                                        <button onclick="window.history.back();" class="btn btn-secondary"><strong><i class="fas fa-arrow-left"></i> Kembali</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM -->
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
    });

    $(document).ready(function() {
        if ($('#ckb').is(":checked")) {
            $('.disb').prop('disabled', true);
            $('.rmckb').remove();
            $('#countb').val('0');
        }
        if ($('#ckc').is(":checked")) {
            $('.disc').prop('disabled', true);
            $('.rmckc').remove();
            $('#countc').val('0');
        }
        $('#ckb').change(function() {
            if ($(this).is(":checked")) {
                $('.disb').prop('disabled', true);
                $('.rmckb').remove();
                $('#countb').val('0');
            } else {
                $('.disb').prop('disabled', false);
            }
        });
        $('#ckc').change(function() {
            if ($(this).is(":checked")) {
                $('.disc').prop('disabled', true);
                $('.rmckc').remove();
                $('#countc').val('0');
            } else {
                $('.disc').prop('disabled', false);
            }
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
                                        <select name="u[` + (count - 1) + `]" class="ipa form-control">
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
        if ($('#counta').val() != 0) {
            $('#counta').val(function(i, oldval) {
                return --oldval;
            });
        }
    }

    function delslotb() {
        $('#secb' + $('#countb').val()).remove();
        if ($('#countb').val() != 0) {
            $('#countb').val(function(i, oldval) {
                return --oldval;
            });
        }
    }

    function delslotc() {
        $('#secc' + $('#countc').val()).remove();
        if ($('#countc').val() != 0) {
            $('#countc').val(function(i, oldval) {
                return --oldval;
            });
        }
    }

    function form_submit() {
        var formData = new FormData($("#formtipeb")[0]);
        $.ajax({
            url: "<?= base_url('admin/tipeb_update/'); ?>",
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
                        window.location.href = "<?= base_url('admin/laporan/tipeb'); ?>";
                    });
                }
            },
            error: function(returndata) {
                alert(returndata);
            }
        });
    }
</script>