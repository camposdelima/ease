function createStudentController($scope, $http) {
	$(".chosen-select").chosen();
	$('.input-mask-date').mask('99/99/9999');
	$('.phone').mask('(99) 9999-9999');
	$('.cellphone').mask('(99) 9999-9999?9');
	$('.cep').mask('99999-999');
	
	toDatePicker('.date-picker');

};

function listStudentController($scope, $http) {
	$('.menu-load').click(function() {
		var page = $(this).attr('data-page');
		$scope.tpl.contentUrl = page;
	});

	var oTable1 = $('#sample-table-2').dataTable({
		"oLanguage": {
			"sProcessing": "Processando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "Não foram encontrados resultados",
			"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
			"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"oPaginate": {
				"sFirst": "Primeiro",
				"sPrevious": "Anterior",
				"sNext": "Seguinte",
				"sLast": "Último"
			}
		},
		"aoColumns": [{
				"bSortable": true
			},
			null, null, null, {
				"bSortable": false
			}
		]
	});

	$('.teste').html("<a href='#'>teste</a>");

	$('[data-rel="tooltip"]').tooltip({
		placement: tooltip_placement
	});

	function tooltip_placement(context, source) {
		var $source = $(source);
		var $parent = $source.closest('table')
		var off1 = $parent.offset();
		var w1 = $parent.width();

		var off2 = $source.offset();
		var w2 = $source.width();

		if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
		return 'left';
	}

};