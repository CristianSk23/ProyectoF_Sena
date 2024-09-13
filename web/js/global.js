$(document).ready(function () {
    $(document).on("keyup", "#filtro", function () {
        let buscar = $(this).val();
        let url = $(this).attr("data-url");

        $.ajax({
            url: url,
            data: "buscar=" + buscar,
            type: "POST",
            success: function (resp) {
                $("tbody").html(resp);
            }
        })
    });

    $(document).on("click","#agregar",function(){
        let copySelect = $("#copy").html();
    
        $("#agregarResponsable").append(
            "<div class ='col-md-4 row'>"+
                "<div class='col-md-9'"+
                    copySelect+
                "</div>"+
                "<div class='col-md-3 mt-4'><button type='buton' class='btn btn-danger' id='quitar'>-</button></div>"+
            "</div>"
        )
    
    });
    
    $(document).on('click', '.eliminar', function(){
        const aviso = confirm("Esta seguro que desea eliminar el registro")
        if(aviso){

            let tr = $(this).closest('tr')
            let id = tr.find('td:eq(0)').attr('data-id')
            let url = $('.eliminar').attr('data-url')

            $.ajax({
                url: url,
                type: 'POST',
                data: { id: id },
                success: function(response){
                    if(response != ""){
                        $('.messageSuccess').css('display', 'block');
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    }
                }
            })
        }else{
            alert("Se ha cancelado la eliminación")
        }
    })

    



})