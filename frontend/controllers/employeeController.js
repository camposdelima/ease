function createEmployeeController($scope, $http) {
	var ng = $scope;
	var aj = $http;

	$('#btnSaveEmployee').click(function(){
		var data = new Object();
		data.data = ng.employee;
		aj.post('Employees/Save', data).success(function(result){
			console.log(result);
		});
	});

	var getDepartaments = function(){
		aj.get('Employees/GetDepartments').success(function(result) {
			console.log(result);
			ng.listDepartaments = result.data;
		})
	};

	var init = function(){
		getDepartaments();
	};

	init();
};

function listEmployeeController($scope, $http) {

	
};