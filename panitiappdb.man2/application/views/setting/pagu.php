<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN PAGU PPDB PADA TAHUN AKTIF <?php echo $thn ?>
        </h2>
    </div>
    <div class="col-lg-12">
        <div class='btn-group'>
            <a href=<?php echo HOME.'/setting/pagu/add' ?>><button class='btn btn-primary btn-xs'>Tambah Pagu <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
        </div>
        <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gelombang</th>
                    <th>Nama Jalur</th>
                    <th>Daya Tampung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0 ?>
            <?php foreach ($pagu as $row): ?>
                <tr>
                    <td><?php echo ++$no ?></td>
                    <td><?php echo $row['gelombang'] ?></td>
                    <td><?php echo $row['nama_jalur'] ?></td>
                    <td><?php echo $row['daya_tampung'] ?></td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/setting/pagu/update/'.$row['id_gel_jalur']; ?>" >
                            <i class='glyphicon glyphicon-edit icon-white'></i>
                            Edit
                        </a>
                        <a class='btn btn-danger btn-xs' href="<?php echo HOME.'/setting/pagu/delete/'.$row['id_gel_jalur']; ?>" onclick="return konfirmasi('Melakukan penghapusan pagu sangat tidak dianjurkan! Penghapusan pagu sembarangan dapat mengakibatkan kegagalan sistem. Apakah anda yakin pagu nomer <?php echo $no ?> tidak berelasi dengan gelombang dan jalur pendaftaran yang yang telah dan sedang berjalan ?')">
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
