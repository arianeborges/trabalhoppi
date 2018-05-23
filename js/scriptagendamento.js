
  <!-- mascara de telefone -->
jQuery(function ($) {
    $.mask.definitions['~'] = '[+-]';
    //Inicio Mascara Telefone
    $("#telefonepaciente").mask("(99) 9999-9999?9").ready(function (event) {
      var target, phone, element;
      target = (event.currentTarget) ? event.currentTarget : event.srcElement;
      phone = target.value.replace(/\D/g, '');
      element = $(target);
      element.unmask();
      if (phone.length > 10) {
        element.mask("(99) 99999-999?9");
      } else {
        element.mask("(99) 9999-9999?9");
      }
    });
  });