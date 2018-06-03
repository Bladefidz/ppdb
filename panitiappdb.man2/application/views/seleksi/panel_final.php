<div class="row">
    <div class="panel-heading">
        <h2>
            HASIL SELEKSI CALON PESERTA DIDIK BARU TAHUN AKTIF PPDB <?php echo $thn ?>
        </h2>
    </div>
    <div class="col-lg-12">
        <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gelombang</th>
                    <th>Pendaftaran Ditutup</th>
                    <th>Tes</th>
                    <th>Pengumuman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0 ?>
            <?php foreach ($gels as $row): ?>
                <tr>
                    <td><?php echo ++$no ?></td>
                    <td>Gelombang <?php echo $row['gelombang'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['close_date'])) ?></td>
                <?php if ($row['test_date'] === "0000-00-00"): ?>
                    <td><?php echo "Tanpa Tes" ?></td>
                <?php else: ?>
                    <td>
                        <span class="label label-warning" style="font-size: 12px">
                            <?php echo date('d-m-Y', strtotime($row['test_date'])) ?>
                        </span>
                    </td>
                <?php endif; ?>
                    <td>
                        <span class="label label-warning" style="font-size: 12px">
                            <?php echo date('d-m-Y', strtotime($row['announcement_date'])) ?>
                        </span>
                    </td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <div class="btn-group">
                            <a class='btn btn-primary btn-xs' href="<?php echo HOME.'/seleksi/hasil/'.$row['id_gel']; ?>" >
                                <i class='glyphicon glyphicon-list-alt icon-white'></i>
                                Lihat Hasil
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
