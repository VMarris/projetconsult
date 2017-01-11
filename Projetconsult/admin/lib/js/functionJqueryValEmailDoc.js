$(document).ready(function () {
    
    $("#addoc_email2").blur(function () {
        email1 = $("#addoc_email1").val();
        email2 = $("#addoc_email2").val();

        if (($.trim(email1) != '' && $.trim(email2) != '') && (email1 == email2)) {
            recherche = "email=" + email1;
            
            $.ajax({
                type: 'POST',
                data: recherche,
                dataType: "json",
                url: './lib/php/ajax/AjaxRechercheEmail.php',
                success: function (data) {
                    if (data[0].conte === "0") {
                        document.getElementById("diverins2").innerHTML = "";
                    }else{
                        document.getElementById("diverins2").innerHTML = " - Email déjà utilisé";
                    }
                }
            });
        }
    });
});