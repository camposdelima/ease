var myApp = angular.module('app', ['ui']);

function CalendarCtrl($scope) {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    
    $scope.eventCount = 0;

    // For DEMO only  This can be created however you please. 
    // *************
    $scope.events = [
        {
        title: 'All Day Event',
        start: new Date(y, m, 1)},
    {
        title: 'Long Event',
        start: new Date(y, m, d - 5),
        end: new Date(y, m, d - 2)},
    {
        id: 999,
        title: 'Repeating Event',
        start: new Date(y, m, d - 3, 16, 0),
        allDay: false},
    {
        id: 999,
        title: 'Repeating Event',
        start: new Date(y, m, d + 4, 16, 0),
        allDay: false},
    {
        title: 'Meeting',
        start: new Date(y, m, d, 10, 30),
        allDay: false},
    {
        title: 'Lunch',
        start: new Date(y, m, d, 12, 0),
        end: new Date(y, m, d, 14, 0),
        allDay: false},
    {
        title: 'Birthday Party',
        start: new Date(y, m, d + 1, 19, 0),
        end: new Date(y, m, d + 1, 22, 30),
        allDay: false},
    {
        title: 'Click for Google',
        start: new Date(y, m, 28),
        end: new Date(y, m, 29),
        url: 'http://google.com/'}]

    $scope.$watch('events', function(newVal, oldVal, scope) {
        alert('watch fired for [events]');
    });

    $scope.addChild = function() {
        $scope.events.push({
            title: 'Click for Google ' + $scope.events.length,
            start: new Date(y, m, 28),
            end: new Date(y, m, 29),
            url: 'http://google.com/'
        });
        
        $scope.eventCount = $scope.eventCount + 1;
    }
        
    $scope.$watch('eventCount', function(newVal, oldVal, scope) {
        alert('watch fired for [eventCount]');        
    });
}
    
    /*
*  Implementation of JQuery FullCalendar 
*  inspired by http://arshaw.com/fullcalendar/ 
*  
*  Basic Calendar Directive that takes in live events as the ng-model and then calls fullCalendar(options) to render the events correctly. 
*  
*  @joshkurz
*/

myApp.directive('devCalendar',['ui.config', '$parse', function (uiConfig,$parse) {

    uiConfig.devCalendar = uiConfig.devCalendar || {};              
    //returns the calendar
    return {
      require: 'ngModel',
      restrict : "A",
      replace : true,
      transclude : true,
      scope: {
        events: "=ngModel"
      },
       

    link: function (scope, elm, $attrs, ngModel) {
         
      //var devCalendarGet = $parse($attrs.devCalendar);
      var expression,
        options = {
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },

          // add event name to title attribute on mouseover. 
          eventMouseover: function(event, jsEvent, view) {
            if (view.name !== 'agendaDay') {
              $(jsEvent.target).attr('title', event.title);
            }
          },
        
          // Calling the events from the scope through the generic ng-model binding attribute. 
          events: scope.events
        };

      if ($attrs.devCalendar) {
        expression = scope.$eval($attrs.ngModel);
      } else {
        expression = {};
      }
      
      var updateCalendar = function (){
        angular.extend(options, uiConfig.devCalendar, expression);
        var x = $parse($attrs.devCalendar);
        alert(angular.toJson(scope));
        elm.fullCalendar(options);

      }
      //use the options object to create the personalized calendar
      scope.$watch(scope.events,updateCalendar);
    
    }
  };
}]);