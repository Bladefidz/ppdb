<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN PENGGUNA PPDB
        </h2>
    </div>
    <div class="col-lg-12">
        <div class='btn-group'>
            <a href=<?php echo HOME.'/setting/pengguna/add' ?>><button class='btn btn-primary btn-xs'>Tambah Pengguna <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
        </div>
        <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Tanggal Terdaftar</th>
                    <th>TanggaLogin</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0; ?>
            <?php foreach ($pengguna as $row): ?>
                <tr>
                <?php
                    $regDate = explode(' ', $row['register_date']);
                    $logDate = explode(' ', $row['last_log_in']);
                ?>
                    <td><?php echo ++$no ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($regDate[0])).' pada jam '.$regDate[1] ?></td>
                    <td><?php echo date('d-m-Y', strtotime($logDate[0])).' pada jam '.$logDate[1] ?></td>
                    <td><?php echo $row['role_name'] ?></td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/setting/pengguna/update/'.$row['uid']; ?>" >
                            <i class='glyphicon glyphicon-edit icon-white'></i>
                            Edit
                        </a>
                        <a class='btn btn-danger btn-xs' href="<?php echo HOME.'/setting/pengguna/delete/'.$row['uid']; ?>" onclick="return konfirmasi('Menghapus data <?php echo $row['nama_kontak']; ?> ?')">
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
