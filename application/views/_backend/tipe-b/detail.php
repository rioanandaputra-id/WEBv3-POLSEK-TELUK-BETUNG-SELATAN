<link href="<?= base_url('assets/backend/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('assets/backend/summernote/summernote-lite.min.js'); ?>"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <div class="float-left">
                                <h1 class="h5 text-gray-800"><strong>DETAIL LAPORAN TIPE B</strong></h1>
                            </div>
                            <div class="float-right">
                                <form action="<?= base_url('doc/tipeb'); ?>" method="post" target="_blank">
                                    <input type="hidden" name="id" value="<?= $tipeb[0]->ID_TIPEB; ?>">
                                    <button class="btn btn-primary" type="submit"><strong>Print Laporan</strong> <i class="fas fa-print"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            No. Laporan<br>
                            Nama<br>
                            T/Tgl. Lahir<br>
                            Agama<br>
                            No. Tlpn<br>
                            Email<br>
                            Alamat<br>
                            Pekerjaan<br>
                            Dibuat Pada<br>
                            Status<br>
                        </div>
                        <div class="col-10">
                            : <?= "LP/B/" . $tipeb[0]->NO_LAP . "/" . getRomawi(date("n", strtotime($tipeb[0]->CREATE_AT))) . "/" . date("y", strtotime($tipeb[0]->CREATE_AT)) . "/RESTA BALAM/SEKTOR TBS" ?><br>
                            : <?= $tipeb[0]->NAMA_PELAPOR; ?> / <?= $tipeb[0]->JENKEL_PELAPOR; ?><br>
                            : <?= $tipeb[0]->TMPT_LAHIR_PELAPOR; ?>, <?= $tipeb[0]->TGL_LAHIR_PELAPOR; ?><br>
                            : <?= $tipeb[0]->AGAMA_PELAPOR; ?><br>
                            : <?= $tipeb[0]->TLP_PELAPOR; ?><br>
                            : <?= $tipeb[0]->EMAIL_PELAPOR; ?><br>
                            : <?= $tipeb[0]->ALAMAT_PELAPOR; ?><br>
                            : <?= $tipeb[0]->PEKERJAAN_PELAPOR; ?><br>
                            : <?= $tipeb[0]->CREATE_AT; ?> WIB<br>
                            : <?= $tipeb[0]->STATUS; ?> PRINT<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>PERISITIWA YANG DILAPORKAN</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            Waktu Kejadian<br>
                            Tempat Kejadian<br>
                            Apa Yang Terjadi<br>
                        </div>
                        <div class="col-10">
                            : <?= $tipeb[0]->WAKTU_KEJADIAN; ?> WIB<br>
                            : <?= $tipeb[0]->TMPT_KEJADIAN; ?><br>
                            : <?= $tipeb[0]->YG_TERJADI; ?><br>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAMA KORBAN</td>
                                        <th>T/TGL. LAHIR KORBAN</td>
                                        <th>ALAMAT KORBAN</th>
                                    </tr>
                                </thead>
                                <tbody style="color: black;">
                                    <?php
                                    $CI = &get_instance();
                                    $CI->load->model('backend/tipeb_model');
                                    $result = $CI->tipeb->getdet(array("ID_TIPEB" => $tipeb[0]->ID_TIPEB, "KET" => "Korban"));
                                    if ($CI->db->affected_rows() > 0) {
                                        foreach ($result as $record1) : ?>
                                            <tr>
                                                <td><?= $record1->NAMA; ?>,<br><?= $record1->JENKEL; ?></td>
                                                <td><?= $record1->TMPT_LAHIR; ?>,<br><?= $record1->TGL_LAHIR; ?></td>
                                                <td><?= $record1->ALAMAT; ?></td>
                                            </tr>
                                        <?php endforeach;
                                    } else { ?>
                                        <tr>
                                            <td>Pelapor</td>
                                            <td>Pelapor</td>
                                            <td>Pelapor</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAMA TERLAPOR</td>
                                        <th>T/TGL. LAHIR TERLAPOR</td>
                                        <th>ALAMAT TERLAPOR</th>
                                    </tr>
                                </thead>
                                <tbody style="color: black;">
                                    <?php
                                    $CI = &get_instance();
                                    $CI->load->model('backend/tipeb_model');
                                    $result = $CI->tipeb->getdet(array("ID_TIPEB" => $tipeb[0]->ID_TIPEB, "KET" => "Terlapor"));
                                    if ($CI->db->affected_rows() > 0) {
                                        foreach ($result as $record1) : ?>
                                            <tr>
                                                <td><?= $record1->NAMA; ?>,<br><?= $record1->JENKEL; ?></td>
                                                <td><?= $record1->TMPT_LAHIR; ?>,<br><?= $record1->TGL_LAHIR; ?></td>
                                                <td><?= $record1->ALAMAT; ?></td>
                                            </tr>
                                        <?php endforeach;
                                    } else { ?>
                                        <tr>
                                            <td>Lidik</td>
                                            <td>Lidik</td>
                                            <td>Lidik</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAMA SAKSI</td>
                                        <th>T/TGL. LAHIR SAKSI</td>
                                        <th>ALAMAT SAKSI</th>
                                    </tr>
                                </thead>
                                <tbody style="color: black;">
                                    <?php
                                    $CI = &get_instance();
                                    $CI->load->model('backend/tipeb_model');
                                    $result = $CI->tipeb->getdet(array("ID_TIPEB" => $tipeb[0]->ID_TIPEB, "KET" => "Saksi"));
                                    if ($CI->db->affected_rows() > 0) {
                                        foreach ($result as $record1) : ?>
                                            <tr>
                                                <td><?= $record1->NAMA; ?>,<br><?= $record1->JENKEL; ?></td>
                                                <td><?= $record1->TMPT_LAHIR; ?>,<br><?= $record1->TGL_LAHIR; ?></td>
                                                <td><?= $record1->ALAMAT; ?></td>
                                            </tr>
                                        <?php endforeach;
                                    } else { ?>
                                        <tr>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Uraian Kejadian<br>
                        </div>
                        <div class="col-10">
                            :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><br>
                            <textarea id="bb"><?= $tipeb[0]->URAIAN_KEJADIAN; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col">
                            <h1 class="h5 text-gray-800"><strong>CATATAN KEPOLISIAN</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            Tindakan Yang Diambil<br>
                        </div>
                        <div class="col-9">
                            :
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?= $tipeb[0]->TINDAKAN_DIAMBIL; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Tindak Pidana<br>
                            Barang Bukti<br>
                        </div>
                        <div class="col-9">
                            : <?= $tipeb[0]->TINDAK_PIDANA; ?><br>
                            : <?= $tipeb[0]->BRG_BUKTI; ?><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#bb').summernote({
        height: 200,
        toolbar: []
    });
    $('#bb').summernote('disable');
</script>