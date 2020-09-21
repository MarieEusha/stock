$(document).ready(function(){
    $('#search_price').hide()

    $("#toggle").on('click', function (e) {
        $('#search_simple').toggle()
        $('#search_price').toggle()

        $('#tBodyA').empty()
    })

    $("#btnSearch").click(function(e){
        e.preventDefault();
        $('#tBodyA').empty()

        toggleTruc('#btnSearch', true)
        toggleTruc('#toggle', true)

        $.ajax({
            url: articleSearch,
            type:'GET',
            dataType:'json',
            data: {
                search : $("#research").val()
        },
            success:function(response){
                console.log(response)
                toggleTruc('#btnSearch', false)
                toggleTruc('#toggle', false)
                
                response['articles'].forEach(function (element){                
                    let $htmlA = 
                        "<tr>" +
                            "<td>"+
                                element.ref +
                            "</td>" +
                            "<td>"+
                                element.label +
                            "</td>" +
                            "<td>"+
                                element.price +
                            "</td>" +
                        "</tr>"+
                    "</tbody>";

                    $("#tBodyA").append($htmlA);
                    
                })
            },
            error:function(response){
                toggleTruc('#btnSearch', false)
                toggleTruc('#toggle', false)

                alert('error'); 
            },
        })
    });

    $("#btnPrice").click(function(e){
        e.preventDefault();
        $('#tBodyA').empty()

        toggleTruc('#btnPrice', true)
        toggleTruc('#toggle', true)

        $.ajax({
            url: price,
            type:'GET',
            dataType:'json',
            data: {
                prixMin : $("#prixMin").val(),
                prixMax :  $("#prixMax").val()
        },
            success:function(response){
                toggleTruc('#btnPrice', false)
                toggleTruc('#toggle', false)

                response['articles'].forEach(function (element){                
                    let $htmlA = 
                        "<tr>" +
                            "<td>"+
                                element.ref +
                            "</td>" +
                            "<td>"+
                                element.label +
                            "</td>" +
                            "<td>"+
                                element.price +
                            "</td>" +
                        "</tr>"+
                    "</tbody>";

                    $("#tBodyA").append($htmlA);
                    
                })
               

            },
            error:function(response){
                toggleTruc('#btnPrice', false)
                toggleTruc('#toggle', false)

                alert('error'); 
            },
        })
    });

    function toggleTruc(selector, value) {
        $(selector).prop('disabled', value)
    }
});