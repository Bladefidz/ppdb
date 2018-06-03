<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN GELOMBANG TAHUN AKTIF PPDB <?php echo $thn ?>
        </h2>
    </div>
    <div class="col-lg-12">
        <div class='btn-group'>
            <a href=<?php echo HOME.'/setting/gelombang/add' ?>><button class='btn btn-primary btn-xs'>Tambah Gelombang <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
        </div>
        <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gelombang</th>
                    <th>Pendaftaran Dibuka</th>
                    <th>Pendaftaran Ditutup</th>
                    <th>Tes</th>
                    <th>Pengumuman</th>
                    <th>Daftar Ulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0 ?>
            <?php foreach ($gels as $row): ?>
                <tr>
                    <td><?php echo ++$no ?></td>
                    <td>Gelombang <?php echo $row['gelombang'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['open_date'])) ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['close_date'])) ?></td>
                <?php if ($row['test_date'] === "0000-00-00"): ?>
                    <td><?php echo "Tanpa Tes" ?></td>
                <?php else: ?>
                    <td><?php echo date('d-m-Y', strtotime($row['test_date'])) ?></td>
                <?php endif; ?>
                    <td><?php echo date('d-m-Y', strtotime($row['announcement_date'])) ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['recieve_date'])) ?></td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/setting/gelombang/update/'.$row['id_gel']; ?>" >
                            <i class='glyphicon glyphicon-edit icon-white'></i>
                            Edit
                        </a>
                        <a class='btn btn-danger btn-xs' href="<?php echo HOME.'/setting/gelombang/delete/'.$row['id_gel']; ?>" onclick="return konfirmasi('Menghapus data <?php echo $row['gelombang']; ?> ?')">
                            <i class='glyphicon glyphicon-remove icon-white'></i>
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
