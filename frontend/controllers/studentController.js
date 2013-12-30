function createStudentController($scope, $http) {

	var aj = $http;
	var ng = $scope;


	$('#btnSaveStudent').click(function(){
		var data = new Object();
		data.data = ng.student;
		aj.post('Students/Save', data).success(function(result){
			console.log(result);
		});
	});

	var getCities = function(){
		aj.get('Utils/GetCities').success(function(result){
			ng.listCities = result.data;
		});

	};

	getCities();

	$('.input-mask-date').mask('99/99/9999');
	$('.phone').mask('(99) 9999-9999');
	$('.cellphone').mask('(99) 9999-9999?9');
	$('.cep').mask('99999-999');
	
	toDatePicker('.date-picker');

};

function listStudentController($scope, $http) {
	var aj = $http;
	var ng = $scope;

	var getStudents = function(){
		aj.get('Students/Get').success(function(result) {
			console.log(result);
		ng.listStudents = result.data;
	});
	};

     getStudents();
};