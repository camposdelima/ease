function indexController($scope, $http) {
	$scope.tpl = {};
	$scope.tpl.contentUrl = 'frontend/dashboard.html';
	//Faz os loads ajax entre as telas
	$('.menu-load').click(function() {
		var page = $(this).attr('data-page');
		$scope.tpl.contentUrl = page;
		$scope.$apply();
		var li = $(this).parent().next().html();
		$('.breadcrumb').children().remove();
		$('.breadcrumb').append(li);
	});

	//Faz os loads com os breadcrumps
	$('#main-content').on('click','.menu-breadcrump', function() {
		var page = $(this).attr('data-page');
		var li = $('[data-page="' + page + '"]').eq(0).parent().next().html();
		$('.breadcrumb').children().remove();
		$('.breadcrumb').append(li);
		$scope.tpl.contentUrl = page;
	});
	$('.input-mask-date').mask('99/99/9999');
};

function tooltip_placement(context, source) {
	var $source = $(source);
	var $parent = $source.closest('.tab-content')
	var off1 = $parent.offset();
	var w1 = $parent.width();

	var off2 = $source.offset();
	var w2 = $source.width();

	if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
	return 'left';
}