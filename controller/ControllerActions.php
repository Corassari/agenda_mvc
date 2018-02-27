<?php

require_once '../model/Conn.class.php';
require_once '../model/ModelAgenda.php';

class ControllerActions extends Agenda {

    /**
     * Ação que deverá ser executada quando 
     * iniciar o programa
     * 
     */
    var $msg;
    var $error;

    public function __construct() {
        parent::__construct();
    }

    public function actions() {
        $action = filter_input(INPUT_POST, 'action');
        if (!empty($action)) {
            try {
                switch ($action) {
                    case 'calendar':
                        $this->listContacts();
                        break;
                    case 'AddInfo':
                        $this->addInfo($_POST);
                        $this->msg = 'Dados Inseridos com sucesso!';
                        break;
                    case 'EditInfo':
                        $this->editInfo($_POST);
                        $this->msg = 'Dados Alterados com sucesso!';
                        break;
                    case 'RemoveInfo':
                        $this->removeInfo($_POST);
                        $this->msg = 'Dados Removidos com sucesso!';
                        break;
                    default:
                        break;
                }
            } catch (Exception $ex) {
                $this->error = $ex->getMessage();
            }
        }
    }

}

$controller = new ControllerActions();
$controller->actions();

if (!$controller->error) {
    $arr['result'] = true;
    $arr['msg'] = $controller->msg ? $controller->msg : '';
} else {
    $arr['result'] = false;
    $arr['msg'] = $controller->error;
}

echo json_encode($arr);
