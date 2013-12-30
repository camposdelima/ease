function createVehicleController($scope, $http) {

	var ng = $scope;
	var aj = $http;
	
	$('#btnSaveVehicle').click(function () {
		var data = new Object();
		data.data = ng.vehicle;
		aj.post('Vehicles/Save', data).success(function(result){
			console.log(result);
		});
	})

	var getColors = function(){
		aj.get('Vehicles/GetColors').success(function(result){
			ng.listColors = result.data;
		});
	};

	var getModels = function(){
		aj.get('Vehicles/GetModels').success(function(result){
			ng.listModels = result.data;
		});
	};

	var getEmployees = function(){
		aj.get('Employees/Get').success(function(result){
			ng.listEmployees = result.data;
		});
	};

	var init = function(){
		getColors();
		getModels();
		getEmployees();
	};

	init();

};

function listVehicleController($scope, $http) {
 
	var aj = $http;
	var ng = $scope;

	var getVehicles = function(){
		aj.get('Vehicles/Get').success(function(result) {
			ng.listVehicles = result.data;
		});
	};

	ng.editVehicle = function(vehicle){
		console.log(vehicle);
	};
	
    getVehicles();
};