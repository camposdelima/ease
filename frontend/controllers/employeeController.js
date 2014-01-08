function createEmployeeController($scope, $http, sharedProperties) {
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
		
		if (sharedProperties.getObject() != null){
			ng.employee = sharedProperties.getObject();
			sharedProperties.setObject(null);
		}
	};

	init();
};

function listEmployeeController($scope, $http, sharedProperties) {

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
	
	ng.editEmployee = function(employee){
		sharedProperties.setObject(employee);
		$scope.tpl.contentUrl = 'frontend/createEmployee.html';
	};
	
    $scope.totalServerItems = 0;
    $scope.pagingOptions = {
        pageSizes: [10, 25, 50], //page Sizes
        pageSize: 10, //Size of Paging data
        currentPage: 1 //what page they are currently on
    };
    self.getPagedDataAsync = function (pageSize, page, searchText) {
        setTimeout(function () {
            aj.get('Employees/Get').success(function(result) {
				ng.listEmployees = result.data;
				
				var pagedData = ng.listEmployees.slice((page - 1) * pageSize, page * pageSize);
				$scope.myData = pagedData;
				$scope.totalServerItems = ng.listEmployees.length;
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
        columnDefs: [{ field: 'name', displayName: 'Funcionário', sortable: true},
					 { field: 'user.username', displayName: 'Usuário', sortable: true},
					 { field: 'row.entity', displayName: 'Opções', cellTemplate: '<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons"><a class="blue" href="#"><i class="icon-zoom-in bigger-130"></i></a><a class="green" ng-click="editEmployee(row.identity)" href="#"><i class="icon-pencil bigger-130"></i></a><a class="red" href="#"><i class="icon-trash bigger-130"></i></a></div>''}]
    };
};