$(document).ready(function () {
    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Format non valide.");


    $("#form_ajout_doc").validate({
        rules: {
            email1: "required",
            email2: {
                equalTo: "#addoc_email1"
            },
            mdp1: "required",
            mdp2: {
                equalTo: "#addoc_mdp1"
            },
            nom: "required",
            prenom: "required",

            submitHandler: function (form) {
                form.submit();
            }
        }
    });

});

$(document).ready(function () {
    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Format non valide.");


    $("#form_ajout_adm").validate({
        rules: {
            email1: "required",
            email2: {
                equalTo: "#adadm_email2"
            },
            mdp1: "required",
            mdp2: {
                equalTo: "#adadm_mdp1"
            },

            submitHandler: function (form) {
                form.submit();
            }
        }
    });

});

