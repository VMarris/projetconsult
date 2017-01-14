$(document).ready(function(){
   $('#choixjourdv').remove();
   
   $('#chjrdv').change(function(){
       var param = $(this).attr('name');
       var val = $(this).val();
       var url = 'index.php?page=gestionrdvdoc&' + param + '=' + val + '&choixjourdv=1';       
       location.href = url;
   });
});