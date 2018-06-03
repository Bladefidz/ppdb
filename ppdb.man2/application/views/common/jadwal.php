<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Jadwal Pendaftaran PPDB MAN 2 Ponorogo <?php echo $thnAjar ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive table-bordered">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Gelombang</th>
                                <th>Dibuka</th>
                                <th>Ditutup</th>
                                <th>Tes</th>
                                <th>Pengumuman</th>
                                <th>Daftar Ulang</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($gelsDetail as $rd):
                            $dateOpen = new \DateTime($rd['open_date']);
                            $dateClose = new \DateTime($rd['close_date']);

                            if ($rd['test_date'] != null) {
                                $td = new \DateTime($rd['test_date']);
                                $testDate = $td->format("d-m-Y");
                            } else {
                                $testDate = "Tanpa tes";
                            }

                            $announcementDate = new \DateTime($rd['announcement_date']);
                            $reciveDate = new \DateTime($rd['recieve_date']);
                        ?>
                            <tr>
                                <td><?php echo $rd['gelombang'] ?></td>
                                <td><?php echo date_format($dateOpen, "d-m-Y") ?></td>
                                <td><?php echo date_format($dateClose, "d-m-Y") ?></td>
                                <td><?php echo $testDate ?></td>
                                <td><?php echo date_format($announcementDate, "d-m-Y") ?></td>
                                <td><?php echo date_format($reciveDate, "d-m-Y") ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
