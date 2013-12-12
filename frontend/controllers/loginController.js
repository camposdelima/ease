function loginController($scope, $http) {
		$("#btnLogin").click(function () {
			  $http.post('/Users/Authenticate', user).success(function(data) {
			    console.log(data);
  			  });

		});
};

function show_box(id) {
	 $('.widget-box.visible').removeClass('visible');
	 $('#'+id).addClass('visible');
};