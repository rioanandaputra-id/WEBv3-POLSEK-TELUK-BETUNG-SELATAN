<html>

<head>
    <link href="<?= base_url('assets/backend/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <style>
        /* body {
            font-size: larger;
            font-family: 'Times New Roman', Times, serif;
        } */

        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            /* font: 12pt "Tahoma"; */
            font-size: 12pt;
            font-family: 'Times New Roman', Times, serif;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body style="margin-left: 5%; margin-right:15%;">
    <?php foreach ($tipec as $record) : ?>
        <div class="book">
            <div class="page">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="float-left"><strong>POLRI DAERAH LAMPUNG</strong></div>
                                <div class="float-right"><strong>MODEL C-1</strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong>
                                    KOTA BANDAR LAMPUNG<br>
                                    SEKTOR TELUK BETUNG SELATAN<br>
                                </strong>
                                <u>Jl. Gatot Subroto No.130, Sukaraja, Bumi Waras, 35226</u><br>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="text-center">
                                    <img src="<?= base_url('assets/backend/img/polri-black.png') ?>" width="100px" height=""><br>
                                    <strong><u>TANDA BUKTI LAPORAN KEHILANGAN BARANG/SURAT</u></strong><br>
                                    Nomor: LP/C/<?= $record->ID_TIPEC; ?>/<?= getRomawi(date('n')) ?>/2021/RESTA BALAM/SEKTOR TBS
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                ----- Yang bertanda tangan dibawah ini menerangkan bahwa pada <?= tgl_indo(date('d-m-Y', strtotime(date('d-m-Y')))); ?> pukul <?= date('H:i'); ?> Wib, telah datang seorang <?= $record->JENKEL; ?> kebangsaan <?= $record->KEWARGANEGARAAN; ?> mengaku : -----
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                Nama<br>
                                Tempat / Tgl. Lahir<br>
                                Agama<br>
                                Pekerjaan<br>
                                Alamat<br>
                            </div>
                            <div class="col-9">
                                : <?= $record->NAMA; ?><br>
                                : <?= $record->TMPT_LAHIR; ?>, <?= $record->TGL_LAHIR; ?><br>
                                : <?= $record->AGAMA; ?><br>
                                : <?= $record->PEKERJAAN; ?><br>
                                : <?= $record->ALAMAT; ?><br>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <u>Melaporkan bahwa telah kehilangan Barang / Surat Penting berupa :</u><br><br>
                                <table border='1px' style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>JENIS</td>
                                            <th>ATAS NAMA</td>
                                            <th>ID</th>
                                            <th>JUMLAH</th>
                                            <th>KET</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $CI = &get_instance();
                                        $CI->load->model('backend/Tipec_model');
                                        $result = $CI->tipec->getdet($record->TOKEN_GENERATE);
                                        foreach ($result as $record1) : ?>
                                            <tr>
                                                <td><?= $record1->JENIS_KEHILANGAN; ?></td>
                                                <td><?= $record1->IDENTITAS_NAMA; ?></td>
                                                <td><?= $record1->NOMOR_IDENTITAS; ?></td>
                                                <td><?= $record1->JUMLAH_IDENTITAS; ?></td>
                                                <td><?= $record1->KETERANGAN_IDENTITAS; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                ----- Kehilangan tersebut diketahui pada <?= tgl_indo(date('d-m-Y', strtotime($record->TGL_KEJADIAN))); ?>, sekira pukul <?= date('H:i', strtotime($record->TGL_KEJADIAN)) ?> Wib diperkirakan hilang atau tercecer di <?= $record->LOKASI_KEJADIAN; ?>, -----
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                ----- Sesuai dengan Laporan Kehilangan Nomor : LP/C/<?= $record->ID_TIPEC; ?>/<?= getRomawi(date('n')) ?>/2021/RESTA BALAM/SEKTOR TBS, pada <?= tgl_indo(date('d-m-Y', strtotime(date('d-m-Y')))); ?>. -----
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                -----Surat keterangan ini bukan sebagai pengganti atas barang atau surat yang telah hilang, melainkan untuk keperluan mengurus kembali barang atau surat yang telah hilang, demikian untuk dapat dipergunakan sebagaimana mestinya. -----
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <div class="float-left"><br><strong>PELAPOR</strong><br><br><br><br><br><br><strong><?= $record->NAMA; ?></strong></div>
                                <div class="float-right">Bandar Lampung, <?= tgl_indo(date('d-m-Y', strtotime(date('d-m-Y')))); ?><br>
                                    <strong>a.n KEPALA KEPOLISIAN SEKTOR<br>TELUK BETUNG SELATAN
                                    </strong>
                                    <br><br><br><br><br>
                                    <strong>Komisaris Hari Budianto<br>NRP 123456789</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script src="<?= base_url('assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/js/sb-admin-2.min.js') ?>"></script>
</body>

</html>