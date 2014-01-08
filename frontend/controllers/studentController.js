/// <reference path="../plugins/ng-grid-reorderable.js" />
/// <reference path="../ng-grid-1.0.0.debug.js" />

function createStudentController($scope, $http, sharedProperties) {

	var aj = $http;
	var ng = $scope;


	$('#btnSaveStudent').click(function(){
		var data = new Object();
		data.data = ng.student;
		ng.student.branch = {'id': 1};
		aj.post('Students/Save', ng.student).success(function(result){
			console.log(result);
		});
	});

	var getCities = function(){
		aj.get('Utils/GetCities').success(function(result){
			ng.listCities = result.data;
		});

	};

	getCities();
	
	var init = function(){
		getCities();
		
		if (sharedProperties.getObject() != null){
			ng.student = sharedProperties.getObject();
			sharedProperties.setObject(null);
		}
	};

	$('.input-mask-date').mask('99/99/9999');
	$('.phone').mask('(99) 9999-9999');
	$('.cellphone').mask('(99) 9999-9999?9');
	$('.cep').mask('99999-999');
	
	toDatePicker('.date-picker');

};

var plugins = {};
function listStudentController($scope, $http, sharedProperties) {
	var aj = $http;
	var ng = $scope;
	var self = this;	
    $('body').layout({
        applyDemoStyles: true,
        center__onresize: function (x, ui) {
            // may be called EITHER from layout-pane.onresize OR tabs.show
            plugins.ngGridLayoutPlugin.updateGridLayout();
        }
    });
	plugins.ngGridLayoutPlugin = new ngGridLayoutPlugin();
    $scope.mySelections = [];
    $scope.mySelections2 = [];
    $scope.myData = [];
    $scope.filterOptions = {
        filterText: "",
        useExternalFilter: false,
    };
	
	$scope.editStudent = function(student){
		sharedProperties.setObject(student);
		$scope.tpl.contentUrl = 'frontend/createStudent.html';
	};
	
    $scope.totalServerItems = 0;
    $scope.pagingOptions = {
        pageSizes: [10, 25, 50], //page Sizes
        pageSize: 10, //Size of Paging data
        currentPage: 1 //what page they are currently on
    };
    self.getPagedDataAsync = function (pageSize, page, searchText) {
        setTimeout(function () {
            aj.get('Students/Get').success(function(result) {
				ng.listStudents = result.data;
				
				var pagedData = ng.listStudents.slice((page - 1) * pageSize, page * pageSize);
				$scope.myData = pagedData;
				$scope.totalServerItems = ng.listStudents.length;
				if (!$scope.$$phase) {
					$scope.$apply();
				}
			});
        }, 100);
    };
    $scope.$watch('pagingOptions', function () {
        self.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage, $scope.filterOptions.filterText);
    }, true);
    $scope.$watch('filterOptions', function () {
        self.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage, $scope.filterOptions.filterText);
    }, true);
    self.getPagedDataAsync($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);
    $scope.gridOptions = {
		data: 'myData',
		jqueryUITheme: false,
		jqueryUIDraggable: false,
        showSelectionCheckbox: false,
        multiSelect: false,
        showGroupPanel: false,
        showColumnMenu: false,
        enableCellSelection: false,
        enableCellEditOnFocus: false,
		plugins: [plugins.ngGridLayoutPlugin],
        enablePaging: true,
        showFooter: true,
		showFilter: true,
		enableColumnResize: true,
        totalServerItems: 'totalServerItems',
        filterOptions: $scope.filterOptions,
        pagingOptions: $scope.pagingOptions,
        columnDefs: [{ field: 'name', displayName: 'Nome', sortable: true},
					 { field: 'phone', displayName: 'Telefone', sortable: true},
					 { field: 'address', displayName: 'Endereço', sortable: true},
					 { field: 'row.entity', displayName: 'Opções', cellTemplate: '<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="blue" href="#"><i class="icon-zoom-in bigger-130"></i></a><a class="green" ng-click="editStudent(row.identity)" href="#"><i class="icon-pencil bigger-130"></i></a><a class="red" href="#"><i class="icon-trash bigger-130"></i></a></div>''}]
    };    
};