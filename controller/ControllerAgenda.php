<?php

require_once 'model/Conn.class.php';
require_once 'model/ModelAgenda.php';

class ControllerAgenda extends Agenda {

    /**
     * Ação que deverá ser executada quando 
     * iniciar o programa
     * 
     */
    public function __construct() {
        parent::__construct();
        if (filter_input(INPUT_GET, 'acresMonth')) {
            parent::setAcresMonth(filter_input(INPUT_GET, 'acresMonth'));
        } elseif (filter_input(INPUT_GET, 'decresMonth')) {
            parent::setDecresMonth(filter_input(INPUT_GET, 'decresMonth'));
             
        }
    }

    public function descMonth(){
        $arrMonth = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        $arrMeses = array(
            "Janeiro"
            ,"Fevereiro"
            ,"Março"
            ,"Abril"
            ,"Maio"
            ,"Junho"
            ,"Julho"
            ,"Agosto"
            ,"Setembro"
            ,"Outubro"
            ,"Novembro"
            ,"Dezembro");
        
       return str_replace($arrMonth,$arrMeses, date('M',$this->getNewDate()));
    }
    
    public function redirectPage() {
        $redirect = filter_input(INPUT_GET, 'redirect');
        if (!empty($redirect)) {
            $path = 'view/' . $redirect . '.php';
            if (file_exists($path)) {
                include $path;
                $this->getModalActions();
            } else {
                include 'view/View404.php';
            }
        } else {
            if (file_exists('view/ViewAgenda.php')) {
                include 'view/ViewAgenda.php';
                $this->getModalActions();
            } else {
                include 'view/View404.php';
            }
        }
    }

    public function getModalActions() {
        $modal = filter_input(INPUT_GET, 'modal');
        if (!empty($modal)) {
            $path = 'view/View' . $modal . '.php';
            if (file_exists($path)) {
                include $path;
            }
        }
    }

    public function actions() {
        $sction = filter_input(INPUT_GET, 'action');
        if (!empty($action)) {
            try {
                switch ($action) {
                    case 'calendar':
                        $this->listContacts();
                        break;
                    case 'addInfo':
                        $this->addInfo();
                        $msg = 'Dados inseridos com sucesso!';
                        break;
                    case 'editInfo':
                        $this->editInfo();
                        $msg = 'Dados alterados com sucesso!';
                        break;
                    case 'removeInfo':
                        $this->removeInfo();
                        $msg = 'Dados Removidos com sucesso!';
                        break;
                    case 'removeInfo':
                        $this->removeInfo();
                        break;
                    default:

                        break;
                }
            } catch (Exception $ex) {
                echo '<strong>Erro:</strong><br>' . $ex->getMessage();
            }
        }
    }

}
