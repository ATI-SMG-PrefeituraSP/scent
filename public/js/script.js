//variáveis globais //

var dataTable; //guarda os datatables

//ajusta a lingua paraportuguês
var dataTableLang = {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
};

//função que roda quando a página termina de carregar
$(document).ready(function() {

    //inicializa todos os tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // transforma os combos em select2
    $('.select2').select2();

    // transforma os colorpickers
    $('.colorpicker').colorpicker();
});

/** Funções personalizadas */

/**
 * Exibe uma mensagem de confirmação e depois exclui um registro
 * @param url: URL da rota que deve ser chamada para excluir
 * @param csrfToken token laravel para certificar de que o usuário logado é quem está solicitando a requisição
 */
function deletarRegistro(url) {

    //verifica se o usuário realmente quer fazer isso
    var confirmation = confirm("Você realmente deseja excluir este registro?");

    //se ele confirmar, exclui
    if(confirmation)
    {
        //faz uma chamada ajax do tipo delete, por segurança
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            complete: function(data){
                
                //exibe um modal avisando que a operação ocorreu com sucesso
                doModal('excluir_modal', 'Excluir registro', data.responseText, "hideModal('excluir_modal')", "");

                //atualiza os datatables
                dataTable.ajax.reload();
            }
        });
    }
}

/**
 * Cria um modal dinamicamente
 * @param {*} placementId: id do modal
 * @param {*} heading Título do modal
 * @param {*} formContent Contepudo do modal
 * @param {*} strSubmitFunc função chamada ao clicar no botão do modal
 * @param {*} btnText texto do botão
 */
function doModal(placementId, heading, formContent, strSubmitFunc, btnText)
{
    var html =  '<div id="modalWindow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
    html += '<div class="modal-dialog" role="document">';
    html += '<div class="modal-content">';
    html += '<div class="modal-header">';
    html += '<h5>'+heading+'</h5>'
    html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    html += '<span aria-hidden="true">&times;</span>';
    html += '</button>';
    html += '</div>';
    html += '<div class="modal-body">';
    html += '<p>';
    html += formContent;
    html += '</div>';
    html += '<div class="modal-footer">';
    if (btnText!='') {
        html += '<span class="btn btn-success"';
        html += ' onClick="'+strSubmitFunc+'">'+btnText;
        html += '</span>';
    }
    html += '<span class="btn" data-dismiss="modal">';
    html += 'Fechar';
    html += '</span>'; // close button
    html += '</div>';  // footer
    html += '</div>';  // modal-content
    html += '</div>';  // modal-dialog
    html += '</div>';  // modalWindow
    $("#"+placementId).html(html);
    $("#modalWindow").modal();
}

/**
 * Fecha um modal
 */
function hideModal(id)
{
    // Using a very general selector - this is because $('#modalDiv').hide
    // will remove the modal window but not the mask
    $('#'+id).modal('hide');
}

/**
 * Imprime um canvas
 * @param {string} id do canvas 
 * @param {string} titulo que deve aparecer na impressão
 */
function imprimeCanvas(id, titulo)
{
    var canvas=document.getElementById(id);
    var data = canvas.toDataURL();
    var win=window.open();
    
    win.document.write("<h1>"+titulo+"</h1><br><img src='"+data+"' style='width: 100%' />");

    $(win.document).ready(function() {
        win.print();
        win.close();
    });
    
}


function baixarArquivo(url, arquivo)
{
    //faz uma chamada ajax do tipo post para baixar um arquivo
    $.ajax({
        url: url,
        type: 'get',
        data: {arquivo: arquivo},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/download',
            'Content-Disposition': 'attachment'
        },
        success: function(data, s, jq) {
            console.log(jq.getResponseHeader('content-type'));

            var json = JSON.stringify(data);
            var blob = new Blob([json], {type: "octet/stream"});
            var url  = window.URL.createObjectURL(blob);
            window.location.assign(url);
        }
    });
}

/**
 * Copia o conteúdo de um txt para o clipboard
 * @param {*} id do txt
 */
function copiarParaClipboard(id) {
    /* Get the text field */
    var copyText = document.getElementById(id);
  
    /* Select the text field */
    copyText.select();
  
    /* Copy the text inside the text field */
    document.execCommand("copy");
}