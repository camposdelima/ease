angular.module('app',['ngTable']).service('sharedProperties', function () {
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