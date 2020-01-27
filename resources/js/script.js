require('jquery-datepicker');


$(document).ready(function(){
    $("#birthday").datepicker();
    $("#issued").datepicker();
    $("#phone").mask("+7 999 9999999");
});
