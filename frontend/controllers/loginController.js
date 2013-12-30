function loginController($scope, $http) {

	var ng = $scope;
	var aj = $http;

		$("#btnLogin").click(function (e) {
			e.preventDefault();
			console.log(ng.user);
			  aj.post('Users/Authenticate', ng.user).success(function(data) {
			    alert(data.message);
  			  });

		});
};

function show_box(id) {
	 $('.widget-box.visible').removeClass('visible');
	 $('#'+id).addClass('visible');
};