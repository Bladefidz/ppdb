<div class="row">
    <div class="panel-heading">
        <h2>
            PENGATURAN KONTAK PPDB
        </h2>
    </div>
    <div class="col-lg-12">
        <div class='btn-group'>
            <a href=<?php echo HOME.'/setting/kontak/add' ?>><button class='btn btn-primary btn-xs'>Tambah Kontak <i class='glyphicon glyphicon-plus icon-white'></i></button></a>
        </div>
        <table class="table col-sm-12 table-bordered table-striped table-condensed cf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Hp</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0 ?>
            <?php foreach ($kontak as $row): ?>
                <tr>
                    <td><?php echo ++$no ?></td>
                    <td><?php echo $row['nama_kontak'] ?></td>
                    <td><?php echo $row['alamat'] ?></td>
                    <td><?php echo $row['telepon'] ?></td>
                    <td><?php echo $row['hp'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td style='padding: 0px; vertical-align: middle; word-break: break-all;'>
                        <a class='btn btn-warning btn-xs' href="<?php echo HOME.'/setting/kontak/update/'.$row['id_kontak']; ?>" >
                            <i class='glyphicon glyphicon-edit icon-white'></i>
                            Edit
                        </a>
                        <a class='btn btn-danger btn-xs' href="<?php echo HOME.'/setting/kontak/delete/'.$row['id_kontak']; ?>" onclick="return konfirmasi('Menghapus data <?php echo $row['nama_kontak']; ?> ?')">
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
