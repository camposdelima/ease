var module = angular.module('myApp', ['ui.calendar', 'ui.bootstrap']);

function CalendarCtrl($scope, $http, $rootScope) {

	var ng = $scope;
	var aj = $http;
	var $ = jQuery;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
	var currentDate = null;
	
	
	toDatePicker('.date-picker');

    ng.changeTo = 'Brazilian';
    /* event source that pulls from google.com */
    ng.eventSource = [];
    ng.otherEvents = [];
    ng.events = [];	
    ng.lessonsFilter = {};
    ng.currentLesson = {};
	ng.filter = {};

    ng.getStudent = function(){
    	aj.get('Students/Get').success(function(result){
    		ng.listStudents = result.data;
    	});
    };

    ng.getEmployee = function(){
    	aj.get('Employees/Get').success(function(result){
    		ng.listEmployees = result.data;
    	});
    };

    ng.getCategory = function(){
    	aj.get('Utils/GetCategories').success(function(result){
    		ng.listCategories = result.data;
    	});
    };

    	ng.getLessons = function(){
	    	aj.post('Lessons/Get', ng.filter).success(function(result){
	    	  result = $(result.data);
			  result.each(function(){
				this.title = this.employee.name + ' - ' + this.vehicle.plate;
				this.start = this.start.date;
				this.end = this.end.date;
				this.color = ((this.student == null) ? "green": "red");
				this.allDay = false;
			  });

			  $.merge(ng.otherEvents, result);

	    	});
	    };


	ng.alterEvent = function(){
		ng.$apply(function(){
			 for(var i = 0; i < ng.otherEvents.length; i++)
			 {
				ng.otherEvents.splice(i);
			 }
			});
	};
	
	ng.clearDays = function(){
		ng.$apply(function(){
			 for(var i = 0; i < ng.events.length; i++)
			 {
				ng.events.splice(i);
			 }
			});
	};

    /* event source that calls a function on every view switch */
    ng.eventsF = function (start, end, callback) {
      var events = [];
      callback(events);
    };
	
	ng.getFiltersForLessons = function(date){
		  var filter = new Object();
-		  filter.minDate = date;
-		  filter.maxDate = date;
		  filter.employee = ng.filter.employee;
		  filter.student = ng.filter.student;
		  filter.category = ng.filter.category;
		  return filter;
	};
	
    /* alert on eventClick */
    ng.alertEventOnClick = function( date, allDay, jsEvent, view ){

		if (jsEvent.name == 'agendaMonth')
		{
		  currentDate = date.day;
    	  ng.changeView('agendaDay', ng.myCalendar1);		  
		  ng.changeDate(ng.myCalendar1,date.start);
		  ng.getLessons(ng.getFiltersForLessons(date.day));
		}
		  
		  //EVENTO NO CLICK DO DIA DA AGENDA
		  if (jsEvent.name == 'agendaDay')
		  {
			//Mesmo dia ele abre o modal para o save do Aluno
			if(currentDate == date.day)
			{
				ng.currentLesson = date;
				//To do open-modal
			} else {
			//Faz a pesquisa denovo pq é outro dia.
				currentDate = date.day;
				ng.changeDate(ng.myCalendar1,date.start);
			    ng.getLessons(ng.getFiltersForLessons(date.day));
			}
		  }
    };
	
    /* alert on Drop */
     ng.alertOnDrop = function(event, dayDelta, minuteDelta, allDay, revertFunc, jsEvent, ui, view){
        ng.$apply(function(){
          ng.alertMessage = ('Event Droped to make dayDelta ' + dayDelta);
        });
    };
    /* alert on Resize */
    ng.alertOnResize = function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view ){
        ng.$apply(function(){
          ng.alertMessage = ('Event Resized to make dayDelta ' + minuteDelta);
        });
    };
    /* add and removes an event source of choice */
    ng.addRemoveEventSource = function(sources,source) {
      var canAdd = 0;
      angular.forEach(sources,function(value, key){
        if(sources[key] === source){
          sources.splice(key,1);
          canAdd = 1;
        }
      });
      if(canAdd === 0){
        sources.push(source);
      }
    };
    /* add custom event*/
    ng.addEvent = function(events) {
	
	//$.merge(ng.events, events);
      // ng.events.push({
        // title: 'Open Sesame',
        // start: new Date('2014-01-07 13:00:00'), 
		// end: new Date('2014-01-07 13:50:00'),
		// allDay: false,
      // });
    };
    /* remove event */
    ng.remove = function(index) {
      ng.events.splice(index,1);
    };
    /* Change View */
    ng.changeView = function(view,calendar) {
	  $(calendar).fullCalendar('changeView',view);
    };
	
	ng.changeViewer = function(view){
		//console.log(view);
	};
	
	/* Change View */
    ng.changeDate = function(calendar,date) {
      $(calendar).fullCalendar('gotoDate',date);
    };

    /* Change View */
    ng.renderCalender = function(calendar) {
	  //console.log(calendar + ' isso é renderCalender');
      $(calendar).fullCalendar('render');
    };



    /* config object */
    ng.uiConfig = {
      calendar:{
        height: 450,
        editable: false,
        header:{
			left: 'today prev,next',
			center: 'title',
			right: 'month',
		},
        eventClick: ng.alertEventOnClick,
        eventDrop: ng.alertOnDrop,
        eventResize: ng.alertOnResize
      }
    };

	ng.uiConfig.calendar.buttonText = {
			today:    'Hoje',
			month:    'Mês',
			week:     'Semana',
			day:      'Dia'
    };

	ng.uiConfig.calendar.dayNames = ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sabado"];
	ng.uiConfig.calendar.dayNamesShort = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"];

	ng.uiConfig.calendar.monthNames = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
	ng.uiConfig.calendar.monthNamesShort = ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];
    /* event sources array*/
    ng.eventSources = [ng.events, ng.eventSource, ng.eventsF, ng.otherEvents];
    ng.eventSources2 = [ng.calEventsExt, ng.eventsF, ng.events];

    ng.getDays = function(){
    	ng.clearDays();
		console.log(ng.filter);
    	aj.post('Lessons/GetDays', ng.filter).success(function(result){
    		result = $(result.data);
    		console.log(result);
			result.each(function(){
				this.title = ((this.full == true) ? "Indisponível" : "Disponível");
				this.color = ((this.full == true) ? "red" : "green");
				this.start = this.day;
				this.allDay = true;
			});


			$.merge(ng.events, result);
		});
    };

	
	ng.alterLessonDayByDate = function(date){
			ng.alterEvent();
			currentDate = date;
			ng.getLessons(ng.getFiltersForLessons(date));
	};
	
    $(document).ready(function(){

		ng.getStudent();
		ng.getEmployee();
		ng.getCategory();
		ng.getDays();

		$('#btnBuscar').click(function(){
			ng.getDays();
		});

		$('#calendar').on('click','.fc-button-month', function(){
			ng.alterEvent();		
		});
		
		$('.changeFilter').click(function(){
			if ($('.widget-body').css('display') == 'none'){
				$('.widget-body').show('slow');
				$('.icon').removeClass('icon-angle-right').addClass('icon-angle-down');
			} else {
				$('.widget-body').hide('slow');
				$('.icon').removeClass('icon-angle-down').addClass('icon-angle-right');
			}
		});
	
	
		$('#calendar').on('click','.fc-button-prev', function(){
			ng.alterLessonDayByDate(ng.myCalendar1.fullCalendar('getView'));
		});
		
		$('#calendar').on('click','.fc-button-next', function(){
			ng.alterLessonDayByDate(ng.myCalendar1.fullCalendar('getView'));
		});
		
		$('#calendar').on('click','.fc-button-today', function(){
			ng.alterLessonDayByDate(ng.myCalendar1.fullCalendar('getView'));
		});
	});
};


/* EOF */