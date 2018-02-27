<!-- Modal -->
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Compromisso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalForm" role="form" action="">
                  <input type="hidden" name="action" value="AddInfo">
                <div class="modal-body">
                    <div class="row col-margin">
                        <div class="col-md-6">
                            <label>Data</label>
                            <input class="form-control data-mask" name="DATA" required="true">
                        </div>
                        <div class="col-md-6">
                            <label>Hora</label>
                            <input class="form-control hora-mask" name="HORA" required="">
                        </div>
                        <div class="col-md-12">
                            <label>Observação</label>
                            <input class="form-control" maxlength="80" name="OBS">
                        </div>
                        <div class="col-md-6">
                            <label>Tipo</label>
                            <select class="form-control" name="TIPO">
                                <option value="1">Normal</option>
                                <option value="2">Aniversário</option>
                                <option value="4">Compromisso</option>
                                <option value="3">Aviso</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Importante</label>
                            <br>
                            <label><input type="radio" name="IMPORTANTE" value="S"> Sim</label>
                            <label><input type="radio" name="IMPORTANTE" value="N" checked=""> Não</label>
                        </div>
                    </div>
                    <div id="callback"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
            <div id="msg"></div>
        </div>
    </div>
</div>
