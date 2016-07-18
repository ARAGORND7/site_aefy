$(document).ready(function(){
    $('#move_topic').submit(function(e){
        e.preventDefault();
        var cat = 'cat=' + $("select[name='forum_subcategory_id']").val();
        $.ajax({
            type : 'GET',
            url  : $('input[name="url"]').val(),
            data : cat,
            success: function(server_response){
                window.setTimeout('location.reload()', 1000);
            }
        });
    });
});