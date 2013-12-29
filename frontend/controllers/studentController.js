function createStudentController($scope, $http) {
	$(".chosen-select").chosen();
	$('.input-mask-date').mask('99/99/9999');
	$('.phone').mask('(99) 9999-9999');
	$('.cellphone').mask('(99) 9999-9999?9');
	$('.cep').mask('99999-999');
	
	toDatePicker('.date-picker');

};

function listStudentController($scope, $http) {
	var aj = $http;
	var ng = $scope;

	var GetStudents = function(){
		aj.get('Students/Get').success(function(result) {
			console.log(result);
		ng.listStudents = result.data;
	});
	};

     GetStudents();
};