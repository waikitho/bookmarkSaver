var myapp = angular.module('myApp');

myapp.controller('errorCtrl', ['$scope', '$uibModalInstance', 'items',
	function($scope, $uibModalInstance, items) {
	console.log(items);
		$scope.items = items;
	}
]);