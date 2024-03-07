jQuery(function($){$("#cpf").mask("000.000.000-00",{placeholder:"___ . ___ . ___ - __"});});

jQuery(function($){$("#telefone").mask("(99) 9999-99999");
$("#telefone").blur(function(event){if($(this).val().length==15){$('#telefone').mask('(99) 9999-99999');
}else{
$('#telefone').mask('(99) 9999-99999');}});});

jQuery(function($){$("#telefone").mask("(99) 9999-99999");
$("#whatsapp").blur(function(event){if($(this).val().length==15){$('#telefone').mask('(99) 9999-99999');
}else{
$('#whatsapp').mask('(99) 9999-99999');}});});


jQuery(function($){$("#nascimento").mask("99/99/9999");
$("#nascimento").blur(function(event){
if($(this).val().length==15){
$('#nascimento').mask('99/99/9999');}
else{$('#nascimento').mask('99/99/9999');}});
});