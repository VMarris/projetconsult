$(document).ready(function(){
    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Format non valide.");
    
    
    $("#form_inscription").validate({
        rules: {
            email1: "required",
            email2: {
                equalTo: "#email1"
            },
            mdp1: "required",
            mdp2:{
              equalTo:"#mdp1"  
            },
            nom: "required",
            prenom: "required",
            telephone: {
                regex:/^((0)[0-9]{1,2}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}){0,1}$/
            },
            submitHandler: function(form) {
                form.submit();
            }
        }
    });
    
});

$(document).ready(function(){
    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Format non valide.");
    
    
    $("#form_change_compte").validate({
        rules: {
            mdp2:{
              equalTo:"#mdp1_change"  
            },
            telephone: {
                regex:/^((0)[0-9]{1,2}\/[0-9]{2}\.[0-9]{2}\.[0-9]{2}){0,1}$/
            },
            submitHandler: function(form) {
                form.submit();
            }
        }
    });
    
});
