<div class="row">
    <div class="panel-heading">
        <h2>
            Proses Seleksi Calon Peserta Didik PPDB Gelombang <?php echo $gel ?> Tahun Ajaran <?php echo $thn.'/'.($thn+1) ?>
        </h2>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-4">
            <b>NP</b> adalah <i>Nomer Pendaftaran</i>
            <br>
            <b>KAP</b> adalah <i>Kode Akses Pendaftaran</i>
        </div>
        <div class="col-lg-4">
            <b>Skor Tes</b> Otomatis Maksimal Untuk Gelombang Yang Tidak Memiliki Tanggal Tes.
            <br>
            <b>Skor Prestasi</b> Maksimal Adalah <?php echo $selData[0]['max_skor_prestasi'] ?>.
            Jika Ditemukan Skor Prestasi Melebihi Skor Maksimal, Maka <span class="label label-primary">
            Label Biru</span> Mengindikasikan Skor Sebenarnya Sedangkan Skor Tidak Berlabel Adalah Skor Yang Akan
            Ditampilkan Pada Hasil Seleksi.
        </div>
        <div class="col-lg-4">
            <b>Rekomendasi</b> Didasarkan Pada Jalur Pendaftaran Yang Memiliki Daya Tampung Terendah ke Tertinggi.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class='dataTable_wrapper'>
                    <div class='table-toolbar' style='margin-bottom: 15px;'>
                        <div class='btn-group'>
                            <button class='btn btn-success btn-xs disabled'><?php echo $numData; ?> calon peserta didik diseleksi</button>
                        </div>
            <?php if ($numData > 0): ?>
                    </div>
                    <div claa="table-responsive">
                        <table cellspacing="0" width="100%" class='table col-sm-12 table-bordered table-striped table-condensed cf' id='dataTables-seleksi'>
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>NP/KAP</th>
                                    <th>Nama</th>
                                    <th>Pilihan</th>
                                    <th>Skor UAN</th>
                                    <th>Skor Tes</th>
                                    <th>Skor Prestasi</th>
                                    <th>Skor Total</th>
                                    <th>Rekomendasi</th>
                                    <th>Keputusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=0; ?>
                            <?php $i=0; ?>
                            <?php $stopIterJalur = false; ?>
                            <?php foreach($selData as $row): ?>
                                <tr class=''>
                                    <td> <?php echo ++$no; ?></td>
                                    <td> <?php echo $row['kode']; ?> </td>
                                    <td> <?php echo $row['nama']; ?> </td>
                                <?php if(!empty($row['pilihan'])): ?>
                                    <td>
                                        <span class="label label-success" style="font-size: 12px">
                                            <?php echo $row['pilihan']; ?>
                                        </span>
                                    </td>
                                <?php else: ?>
                                    <td>
                                        <span class="label label-danger" style="font-size: 12px">
                                            Tidak Terdaftar
                                        </span>
                                    </td>
                                <?php endif; ?>
                                    <td> <?php echo (int) $row['sel_skor_un']; ?> </td>
                                    <td> <?php echo (int) $row['sel_skor_tes']; ?> </td>
                                <?php if($row['sel_skor_prestasi'] > $row['max_skor_prestasi']): ?>
                                    <td>
                                        <?php echo $row['max_skor_prestasi']; ?>
                                        <br>
                                        <span class="label label-primary" style="font-size: 12px">
                                            <?php echo $row['sel_skor_prestasi']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php $fixSum = $row['skor_total']-($row['sel_skor_prestasi']-$row['max_skor_prestasi']); ?>
                                        <?php echo $fixSum; ?>
                                        <br>
                                        <span class="label label-primary" style="font-size: 12px">
                                            <?php echo $row['skor_total']; ?> </td>
                                        </span>
                                    </td>
                                <?php else: ?>
                                    <td> <?php echo $row['sel_skor_prestasi']; ?> </td>
                                    <td> <?php echo $row['skor_total']; ?> </td>
                                <?php endif; ?>
                                <?php if($no <= $gelKuota): ?>
                                    <?php if($no <= $jalurKuotas[$i]["daya_tampung"]): ?>
                                    <?php else: ?>
                                        <?php $i = $i +1; ?>
                                    <?php endif; ?>
                                    <?php $rec = $jalurKuotas[$i]["id_jalur"]; ?>
                                    <td> <i><?php echo $jalurKuotas[$i]["nama_jalur"] ?></i> </td>
                                <?php else: ?>
                                    <td> <i style="color: red">Tidak Diterima</i> </td>
                                <?php endif ?>
                                <?php if(!empty($row['keputusan'])): ?>
                                    <?php $kep = $row['id_jalur_penerimaan']; ?>
                                    <td>
                                        <span class="label label-success" style="font-size: 12px">
                                            <?php echo $row['keputusan']; ?>
                                        </span>
                                    </td>
                                <?php else: ?>
                                    <?php $kep = 0; ?>
                                    <td>
                                        <span class="label label-danger" style="font-size: 12px">
                                            NA
                                        </span>
                                    </td>
                                <?php endif; ?>
                                    <td>
                                        <div class="btn-group">
                                            <a class='btn btn-primary btn-xs btn-responsive' href="<?php echo HOME.'/seleksi/keputusan/'.$row['id_pendaftaran']."/".$rec."/".$kep ?>" >
                                                <i class='fa fa-check'></i>
                                                Ambil Keputusan
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <table class='table table-striped table-bordered table-hover' id='dataTables-seleksi'>
                    <tr>
                        <td>Data Tidak Ditemukan</td>
                    </tr>
                </table>
            <?php endif; ?>
            <br/>
            </div>
        </div>
    </div>
</div>
