<?php
namespace Models;

/**
 * GelombangModel class
 */
class GelombangModel extends \Core\Model
{
    private $today = null;
    public $isOpen = false;
    public $closeInfo = null;

    public function __construct()
    {
        parent::__construct();

        $this->db->table = 'ppdb_gelombang';
        $this->db->pk = 'id_gel';

        $this->today = new \DateTime("now");
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

    public function add($param = array())
    {
        $query = "INSERT INTO ppdb_gelombang(gelombang, id_tahun_ajaran, open_date, close_date, test_date, announcement_date, recieve_date) ".
            "VALUES(:gel, :idt, :od, :cd, :td, :ad, :rd)";
        return $this->db->query($query, $param);
    }

    public function getbyId($id)
    {
        $query = "SELECT * FROM ppdb_gelombang JOIN ppdb_tahun_ajaran WHERE id_gel = :id";
        $param = array(
            'id' => $id
        );

        return $this->db->query($query, $param);
    }

    public function getGelsYear($year)
    {
        $query = "SELECT * FROM ppdb_gelombang JOIN ppdb_tahun_ajaran ".
            "WHERE ppdb_gelombang.id_tahun_ajaran = ppdb_tahun_ajaran.id_tahun_ajaran ".
            "AND ppdb_tahun_ajaran.tahun_ajaran = :year ORDER BY ppdb_gelombang.gelombang ASC";
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
        for ($gel = 0; $gel < $numGels; ++$gel) {
            // Create new date array object
            $regOpenDate = new \DateTime($gelDetail[$gel]["open_date"]);
            $regCloseDate = new \DateTime($gelDetail[$gel]["close_date"]);
            $studyYearStart = $gelDetail[$gel]["tahun_ajaran"];
            $studyYearEnd = $studyYearStart+1;

            // Compare by year, month and day
            if ($this->today >= $regOpenDate && $this->today <= $regCloseDate) {
                $countdown = $this->today->diff($regCloseDate);
                $openGel = $gelDetail[$gel]["gelombang"];

                $regStats = $this->getGelYear($yearNow, $openGel);
                $regStats['study_year'] = $studyYearStart."/".$studyYearEnd;
                $regStats['countdown'] = $countdown->format("%a");

                $this->isOpen = true;
                $this->closeInfo = $regStats['gelombang']-1;

                return $regStats;
            }
        }
    }

    public function update($param = array())
    {
        $query = "UPDATE ppdb_gelombang SET gelombang = :gel, open_date = :od, close_date = :cd, test_date = :td, announcement_date = :ad, recieve_date = :rd ".
            "WHERE id_gel = :idg AND id_tahun_ajaran = :idt";
        return $this->db->query($query, $param);
    }

    public function delete($id)
    {
        $query = "DELETE FROM ppdb_gelombang WHERE id_gel = :id";
        $param = array(
            'id' => $id
        );
        return $this->db->query($query, $param);
    }
}
