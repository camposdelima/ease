/*angular.module('app',['ngTable']).service('sharedProperties', function () {
        var value = null;

        return {
            getObject: function () {
                return value;
            },
            setObject: function(val) {
                value = val;
            }
        };
    });*/

var module = angular.module('myApp', ['ui.calendar', 'ui.bootstrap', 'ngGrid','localytics.directives']).config([
    '$parseProvider', function($parseProvider) {
      return $parseProvider.unwrapPromises(true);
    }
  ]).service('sharedProperties', function () {
        var value = null;

        return {
            getObject: function () {
                return value;
            },
            setObject: function(val) {
                value = val;
            }
        };
    });
