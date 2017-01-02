$(document).ready(function () {
    
    $("#email2").blur(function () {
        email1 = $("#email1").val();
        email2 = $("#email2").val();

        if (($.trim(email1) != '' && $.trim(email2) != '') && (email1 == email2)) {
            recherche = "email=" + email1;
            
            $.ajax({
                type: 'POST',
                data: recherche,
                dataType: "json",
                url: './admin/lib/php/ajax/AjaxRechercheEmail.php',
                success: function (data) {
                    if (data[0].conte === "0") {
                        document.getElementById("diverins").innerHTML = "";
                    }else{
                        document.getElementById("diverins").innerHTML = " - Email déjà utilisé";
                    }
                }
            });
        }
    });
});