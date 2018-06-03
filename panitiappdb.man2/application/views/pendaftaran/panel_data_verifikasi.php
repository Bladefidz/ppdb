<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">
            DATA CALON PESERTA DIDIK BARU TAHUN AKTIF PPDB <?php echo $thn ?> <strong>TERVERIFIKASI</strong>
        </h2>
    </div>
    <div class="col-lg-12">
        <table class="table table-striped table-hover" style="background: #FFF">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gelombang</th>
                    <th>Pendaftaran Dibuka</th>
                    <th>Pendaftaran Ditutup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0 ?>
            <?php foreach ($gels as $row): ?>
                <tr class="active">
                    <td><?php echo ++$no ?></td>
                    <td>Gelombang <?php echo $row['gelombang'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['open_date'])) ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['close_date'])) ?></td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <div class="btn-group">
                            <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/seleksi/proses/'.$row['id_gel']; ?>" >
                                <i class='glyphicon glyphicon-list-alt icon-white'></i>
                                Lihat
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
