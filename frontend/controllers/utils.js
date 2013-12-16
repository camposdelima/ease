$(document).ready(function(argument) {
	$(document).on('click','date-picker', function() {
		alert('aeeeee');
		$(this).datepicker({
		autoclose: true
	}).next().on(ace.click_event, function() {
		$(this).prev().focus();
	});
});

	$(".chosen-select").chosen();
	$('.input-mask-date').mask('99/99/9999');
	$('.phone').mask('(99) 9999-9999');
	$('.cellphone').mask('(99) 9999-9999?9');
	$('.cep').mask('99999-999');
});

function toDatePicker(input){
$(input).datepicker({
		autoclose: true,
	}).next().on(ace.click_event, function() {
		$(this).prev().focus();
	});
};