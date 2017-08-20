
    $(document).ready(function(){
    $(".btnSubmit").on("click", function(e){

        var commentmessage = $(".commentmessage").val();

        $.post("ajax/save_comment.php", { commentmessage: commentmessage })
            .done(function( response ){
                var li = "<li style='display: none' class='list-group-item'>" + commentmessage + "</li>";
                $('#listupdates').prepend(li);
                $("#listupdates li:first-child").slideDown();
                $(".commentmessage").val('');
            });
        e.preventDefault();
    });
    });

