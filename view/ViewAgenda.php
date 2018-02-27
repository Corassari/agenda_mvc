<?php
//require 'controller/ControllerAgenda.php';
?>
<div class="col-md-3">
    <ul class="list-unstyled alert alert-secondary">
        <li><a href="index.php?modal=AddInfo"><i class="fa fa-plus-circle"></i> Adicionar Agenda</a></li>
    </ul>

    <br>
    <h5>Compromissos Importantes</h5>
    <!--------------------------------------------------------->
    <ul class="list-group list-group-flush">
        <?php
        $ag = new ControllerAgenda();
        try {
            $ls = $ag->lsInfoImp();
            $html = '';
            while ($row = $ls->fetch()) {
                $data = DateTime::createFromFormat('Y-m-d H:i:s', $row['data']);
                $html .= '<li class="list-group-item">'
                        . '<strong> ' . $data->format('d.m') . ' </strong>'
                        . utf8_encode($row['obs'])
                        . '</li>';
            }
        } catch (Exception $ex) {
            $html = '<h6 class="text-center text-muted">' . $ex->getMessage() . '</h6>';
        }
        echo $html;
        ?>
    </ul>
    <!--------------------------------------------------------->
</div>
<div class="col-md-9 table-responsive">
    <div class="row" style="border-top:1px solid #ccc; padding: 10px 0;">
        <div class="col-md-4">
            <a href="?decresMonth=<?= filter_input(INPUT_GET, 'decresMonth') ? filter_input(INPUT_GET, 'decresMonth') - 1 : 1 ?>" class="btn btn-primary btn-sm">< Retroceder</a>
            <a href="?acresMonth=<?= filter_input(INPUT_GET, 'acresMonth') ? filter_input(INPUT_GET, 'acresMonth') + 1 : 1 ?>" class="btn btn-primary btn-sm">Avançar ></a>
        </div>
        <div class="col-md-4 text-center">
            <h4><?= $ag->descMonth() ?></h4>
        </div>                        
    </div>
    <table class="table table-agenda table-striped">
        <thead>
            <tr>
                <th>DOM</th>   
                <th>SEG</th>        
                <th>TER</th>        
                <th>QUA</th>        
                <th>QUI</th>        
                <th>SEX</th>        
                <th>SAB</th>    
            </tr>
        </thead>
        <tbody>
            <?php
            $html = '';
            $days = $ag->lsDays();
            $fDayWeek = $days[0]['dWeek'];
            for ($i = 0; $i <= 34; $i++) {
                $offset = isset($days[($i - $fDayWeek)]) ? ($i - $fDayWeek) : $days[$offset]['day'];
                $uOffset = isset($days[($i - $fDayWeek)]) ? false : true;
                $html .= $i == 0 || $days[$offset]['dWeek'] == 7 ? '<tr>' : '';

                #---------------------------------------------------------------
                #LISTAR TAREFAS DO DIA vs CALENDAR
                #---------------------------------------------------------------
                if ($fDayWeek == $i || $fDayWeek <= $i) {
                    if ($days[$offset]['day'] <= count($days) and !$uOffset) {
                        $html .= '<td>';
                        $html .= '<span class="day">' . $days[$offset]['day'] . '</span><hr>';
                        $html .= '<ul class="list-unstyled">';
                        $ag->setDay($days[$offset]['day']);

                        try {
                            $ls = $ag->lsInfosDay();
                            while ($row = $ls->fetch()) {
                                $html .= '<li><i class="fa fa-circle circle-blue"></i> <a href="?modal=EditInfo&id=' . $row['num'] . '"> ' . utf8_encode($row['obs']) . '</a</li>';
                            }
                        } catch (Exception $ex) {
                            $html .= '';
                        }
                        $html .= '<ul>';
                        $html .= '</td>';
                    } else {
                        $html .= '<td>  </td>';
                    }
                } else {
                    $html .= '<td>  </td>';
                }
                $html .= $i % 6 == 6  ? '</tr>' : '';
            }
            echo $html;
            ?>
        </tbody>
    </table>
</div>