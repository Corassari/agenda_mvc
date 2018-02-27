<?php
//require '../controller/ControllerAgenda.php';
?>
<!-- Modal -->
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Compromisso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalForm" role="form" action="">
                <input type="hidden" name="action" value="EditInfo">
                <input type="hidden" name="ID" value="<?= filter_input(INPUT_GET, 'id') ?>">
                <div class="modal-body">
                    <?php
                    include_once 'controller/ControllerAgenda.php';
                    $edt = new ControllerAgenda();
                    try {
                        $aDados = $edt->getInfosDay(filter_input(INPUT_GET, 'id'));
                        ?>
                        <div class="row col-margin">
                            <div class="col-md-6">
                                <label>Data</label>
                                <input class="form-control data-mask" name="DATA" required="true" value="<?= DateTime::createFromFormat('Y-m-d H:i:s', $aDados['time'])->format('d/m/Y') ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Hora</label>
                                <input class="form-control hora-mask" name="HORA" required="" value="<?= DateTime::createFromFormat('Y-m-d H:i:s', $aDados['time'])->format('H:i:s') ?>">
                            </div>
                            <div class="col-md-12">
                                <label>Observação</label>
                                <input class="form-control" maxlength="80" name="OBS" value="<?= $aDados['obs'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label>Tipo</label>
                                <select class="form-control" name="TIPO">
                                    <option value="1" <?= $aDados['tipo'] == 1 ? 'selected' : '' ?>>Normal</option>
                                    <option value="2" <?= $aDados['tipo'] == 2 ? 'selected' : '' ?>>Aniversário</option>
                                    <option value="4" <?= $aDados['tipo'] == 4 ? 'selected' : '' ?>>Compromisso</option>
                                    <option value="3" <?= $aDados['tipo'] == 3 ? 'selected' : '' ?>>Aviso</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Importante</label>
                                <br>
                                <label><input type="radio" name="IMPORTANTE" value="S"  <?= $aDados['importante'] == 'S' ? 'checked' : '' ?>> Sim</label>
                                <label><input type="radio" name="IMPORTANTE" value="N" <?= $aDados['importante'] == 'N' ? 'checked' : '' ?>> Não</label>
                            </div>
                        </div>
                        <div id="callback"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-warning" id="remove">Remover</button>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                    <?php
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                ?>
            </form>

        </div>
    </div>
</div>
