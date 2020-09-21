$(document).ready(function(){
    $(".delete").click(function(e){
        e.preventDefault();

        $.ajax({
            url: articleDelete,
            type:'POST',
            dataType:'json',
            data: {
                ref : $(this).val()
            },
            success:function(response){
                var a =".ligne" + response.ref;
                $(a).remove()
            },
            error:function(response){
                alert('error'); 
            },
        })
    });
});