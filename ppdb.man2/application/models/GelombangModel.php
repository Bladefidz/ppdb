<?php
namespace Models;

/**
 * GelombangModel class
 */
class GelombangModel extends \Core\Model
{
    private $date = null;
    public $isOpen = false;
    public $closeInfo = null;

    public function __construct()
    {
        parent::__construct();

        $this->db->table = 'ppdb_gelombang';
        $this->db->pk = 'id_gel';

        $this->date= new \DateTime();
        $this->getGelStat();
    }

    public function pilGelombang()
    {
        return $this->db->all();
    }

    private function numGelombangCol()
    {
        return count($this->pilGelombang());
    }

    public function getGelsYear($year)
    {
        $query = "SELECT * FROM ppdb_gelombang JOIN ppdb_tahun_ajaran ".
            "WHERE ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran ".
            "AND ppdb_tahun_ajaran.tahun_ajaran = :year ORDER BY ppdb_gelombang.gelombang";
        $param = array(
            'year' => $year
        );

        return $this->db->query($query, $param);
    }

    public function getGelYear($year, $gel)
    {
        $query = "SELECT * FROM ppdb_gelombang JOIN ppdb_tahun_ajaran ".
            "WHERE ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran ".
            "AND ppdb_tahun_ajaran.tahun_ajaran = :year AND ppdb_gelombang.gelombang= :gel";
        $param = array(
            'gel' => $gel,
            'year' => $year
        );

        return $this->db->query($query, $param)[0];
    }

    public function getGelStat() {
        $yearNow = date('Y');
        $gelDetail = $this->getGelsYear($yearNow);
        $numGels = count($gelDetail);

        $regStats = array();
        for ($gel = 0; $gel < $numGels; $gel++) {
            $studyYearStart = $gelDetail[$gel]["tahun_ajaran"];
            $studyYearEnd = $studyYearStart+1;

            $regStats = array();
            $regStats = $this->getGelYear($yearNow, $gelDetail[$gel]["gelombang"]);
            $regStats['study_year'] = $studyYearStart."/".$studyYearEnd;

            $begin = date('Y-m-d') >= date('Y-m-d', strtotime($gelDetail[$gel]["open_date"]));
            $end = date('Y-m-d') <= date('Y-m-d', strtotime($gelDetail[$gel]["close_date"]));

            if ($begin && $end) {
                $now = date_create(date('Y-m-d'));
                $close = date_create($gelDetail[$gel]["close_date"]);
                $countdown = date_diff($now, $close);
                $regStats['countdown'] = (int) $countdown->format('%a');
                $this->isOpen = true;
                break;
            } else {
                $this->closeInfo = $gelDetail[$gel]["gelombang"];
            }
        }

        return $regStats;
    }
}
