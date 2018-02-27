<?php

/*
 * Classe respnsável pela interação da Agenda
 */

class Agenda {

    public $year;
    public $month;
    Public $day;
    public $dayWeek;
    private $newDate;

    public function __construct() {
        $date = new DateTime();
        $this->setDay($date->format('d'));
        $this->setMonth($date->format('m'));
        $this->setYear($date->format('Y'));
        $this->setNewDate();
    }

    function getNewDate() {
        return $this->newDate;
    }

    private function setNewDate() {
        $this->newDate = mktime(0, 0, 0, $this->getMonth(), $this->getDay(), $this->getYear());
    }

    public function lsInfosDay() {
        $query = "SELECT "
                . "ag_id num"
                . ",ag_obs obs"
                . ",ag_user user"
                . ",ag_imp importacia "
                . ",ag_tipo tipo "
                . "FROM agenda agda "
                . "LEFT JOIN tipos tps on agda.ag_tipo = tps.tp_id and tps.d_e_l <> '*' "
                . "WHERE agda.d_e_l <> '*' "
                . "AND YEAR(ag_time) = '$this->year' "
                . "AND MONTH(ag_time)= '$this->month' "
                . "AND DAY(ag_time) = '$this->day' ";
        try {
            $conn = Conn::Conect()->query($query);
            if (count($conn->fetchAll()) > 0) {
                return Conn::Conect()->query($query);
            } else {
                throw new Exception('Nenhum dado encontrado <small>(' . __FUNCTION__ . ')</small>');
            }
        } catch (nException $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function getInfosDay($num) {
        $query = "SELECT "
                . "ag_id num"
                . ",ag_time time"
                . ",ag_obs obs"
                . ",ag_user user"
                . ",ag_imp importante "
                . ",ag_tipo tipo "
                . "FROM agenda agda "
                . "LEFT JOIN tipos tps on agda.ag_tipo = tps.tp_id and tps.d_e_l <> '*' "
                . "WHERE agda.d_e_l <> '*' "
                . "AND ag_id = '$num' ";

        try {
            $conn = Conn::Conect()->query($query);
            if (count($conn->fetchAll()) > 0) {
                return Conn::Conect()->query($query)->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new Exception('Nenhum dado encontrado <small>(' . __FUNCTION__ . ')</small>');
            }
        } catch (nException $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    /*
     * @author:
     * litar anotações importantes do mês (corrente).
     */

    public function lsInfoImp() {
        $query = "SELECT "
                . "ag_time 'data' "
                . ",ag_obs obs"
                . ",ag_tipo tipo "
                . "FROM agenda agda "
                . "WHERE agda.d_e_l <> '*' "
                . "AND YEAR(ag_time) = '$this->year' "
                . "AND MONTH(ag_time)= '$this->month' "
                . "AND ag_imp = 'S' ";

        try {
            $conn = Conn::Conect()->query($query);
            if (count($conn->fetchAll()) > 0) {
                return Conn::Conect()->query($query);
            } else {
                throw new Exception('Nenhum compromisso importante encontrado!');
            }
        } catch (nException $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function lsDays() {
        $newDate = $this->getNewDate();
        $qtdeDay = date('t', $newDate);
        $arr = array();

        for ($i = 1; $i <= $qtdeDay; $i++) {
            $this->setDay($i);
            $this->setNewDate();

            //incremento no array $arr;
            array_push($arr, array("day" => $i, "dWeek" => $this->getDayWeek()));
        }
        return $arr;
    }

    function setAcresMonth($num) {
        $this->setMonth($this->getMonth() + $num);
        $this->setNewDate();
    }

    function setDecresMonth($num) {
        $this->setMonth($this->getMonth() - $num);
        $this->setNewDate();
    }

    function getDayWeek() {
        return date('N', $this->getNewDate());
    }

    function getYear() {
        return $this->year;
    }

    function getMonth() {
        return $this->month;
    }

    function getDay() {
        return $this->day;
    }

    function setYear($year) {
        $this->year = $year;
    }

    function setMonth($month) {
        $this->month = $month;
    }

    function setDay($day) {
        $this->day = $day;
    }

    public function addInfo(array $aDados) {
        #validar data
        $aDate = explode('/', $aDados['DATA']);
        $vDate = checkdate($aDate[1], $aDate[0], $aDate[2]);
        $query = "INSERT INTO agenda "
                . "(ag_time"
                . ",ag_user"
                . ",ag_obs"
                . ",ag_tipo"
                . ",ag_imp) "
                . "values "
                . "(:ag_time"
                . ",:ag_user"
                . ",:ag_obs"
                . ",:ag_tipo"
                . ",:ag_imp)";

        try {
            if (!$vDate) {
                throw new Exception('Data Inválida');
            }

            $data = DateTime::createFromFormat('d/m/Y H:i:s', ($aDados['DATA'] . '' . $aDados['HORA']))->format('Y-m-d H:i:s');
            $conn = Conn::Conect()->prepare($query);
            $conn->bindValue(':ag_time', $data);
            $conn->bindValue(':ag_user', '1');
            $conn->bindValue(':ag_obs', $aDados['OBS']);
            $conn->bindValue(':ag_tipo', $aDados['TIPO']);
            $conn->bindValue(':ag_imp', $aDados['IMPORTANTE']);
            $conn->execute();
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    public function editInfo(array $aDados) {
        $query = "UPDATE agenda "
                . "SET ag_time = :ag_time "
                . ",ag_tipo = :ag_tipo "
                . ",ag_imp = :ag_imp"
                . ",ag_obs = :ag_obs "
                . "WHERE ag_id = :ag_id ";
        try {
            $time = DateTime::createFromFormat('d/m/Y H:i:s', ($aDados['DATA'] . '' . $aDados['HORA']))->format('Y-m-d H:i:s');
            $conn = Conn::Conect()->prepare($query);
            $conn->bindValue(':ag_time', $time);
            $conn->bindValue(':ag_id', $aDados['ID']);
            $conn->bindValue(':ag_obs', $aDados['OBS']);
            $conn->bindValue(':ag_tipo', $aDados['TIPO']);
            $conn->bindValue(':ag_imp', $aDados['IMPORTANTE']);
            $conn->execute();
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    public function removeInfo(array $aDados) {
        $query = "UPDATE agenda "
                . "SET d_e_l = '*' "
                . "WHERE ag_id = '$aDados[ID]' ";
        try {
            $conn = Conn::Conect()->prepare($query);
            $conn->bindParam(':ag_id', $dados['ID']);
            $conn->execute();
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

}
