function createVehicleController($scope, $http) {

	var ng = $scope;

	$(".chosen-select").chosen();
	$('.input-mask-date').mask('99/99/9999');
	$('.phone').mask('(99) 9999-9999');
	$('.cellphone').mask('(99) 9999-9999?9');
	$('.cep').mask('99999-999');
	$('.date-picker').datepicker({
		autoclose: true
	}).next().on(ace.click_event, function() {
		$(this).prev().focus();
	});

	$('#btnSaveVehicle').click(function () {
		console.log(ng.vehicle);
	})

};

function listVehicleController($scope, $http) {
 
	var aj = $http;
	var ng = $scope;

	var GetStudents = function(){
		aj.get('Vehicles/Get').success(function(result) {
		ng.lista = result.data;
	});
	};

     GetStudents();
};