$(document).ready(function(){
    $("#formname").on("change", "input:checkbox", function(){
        $("#formname").submit();
    });
});
