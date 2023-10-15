8

$("#registrationForm").submit(function(e){
    e.preventDefault();
    $.ajax({
        type : 'POST',
        data: $("#registrationForm").serialize(),
        url : 'url',
        success : function(data){
            
            $("#signup").modal("show");
        }
    });
    return false;
});