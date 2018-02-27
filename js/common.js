/* 
 * Tratamento mascaras de Datas/ Horas
 */
$('.data-mask').datepicker({
    format: 'dd/mm/yyyy'
}).mask("00/00/0000", {clearIfNotMatch: true});
$('.hora-mask').mask("00:00:00", {clearIfNotMatch: true});
$('#modalInfo').modal('show');

$('#remove').click(function () {
    $('#modalForm [name=action]').attr('value', 'RemoveInfo');
})

$('#modalForm').submit(function (e) {
    e.preventDefault()
    var $dados = $(this).serialize();
    $.ajax({
        url: 'controller/ControllerActions.php'
        , data: $dados
        , type: 'post'
        , dataType: 'json'
        , beforeSend: function () {
            $('#callback').html('<h5 class="alert alert-info">Enviando informações!</h5>')
        }
        , success: function ($data) {

            if ($data.result == true) {
                $('#callback').html('<h5 class="alert alert-success">' + $data.msg + '</h5>');
                setTimeout(function () {
                    window.location.href = "index.php"
                }, 2000);
            } else {
                $('#callback').html('<h5 class="alert alert-danger">' + $data.msg + '</h5>')
            }

        }
        , error: function ($data) {
            $('#callback').html('<h5 class="alert alert-danger">' + $data.responseText + '</h5>')
            console.log($data);
        }
    })
})