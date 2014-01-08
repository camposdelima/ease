function loginController($scope, $http) {

	$scope.tpl = {};
	$scope.tpl.contentUrl = 'frontend/login.html';

	var ng = $scope;
	var aj = $http;

		$("#btnLogin").click(function (e) {
			e.preventDefault();
			console.log(ng.user);
			  aj.post('Users/Authenticate', ng.user).success(function(data) {
			    if (data.success){
					$scope.tpl.contentUrl = 'frontend/login.html';
				} else {
				//Todo alert error login
				}
  			  });

		});
};

function show_box(id) {
	 $('.widget-box.visible').removeClass('visible');
	 $('#'+id).addClass('visible');
};