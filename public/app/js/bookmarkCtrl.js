var myapp = angular.module('myApp');

myapp.controller('bookmarkCtrl', ['$scope', '$http', '$uibModal',
	function($scope, $http, $uibModal) {
		// initialize: 
		$scope.currentUser = "nemo";
		$scope.typeFilter = "";
		$scope.sortOn = "";
		$scope.DEFAULT = "Default";
		$scope.getBookmarks = function(userID){
			$http({
			method: 'GET',
			url: '/service/getBookmarks.php',
			params: {'userID':userID}
		}).then(function successCallback(response) {
			$scope.bookmarks = response.data;	
		  }, function errorCallback(response) {			
		  });
		}
		
		$scope.editRow = function (row) {
			if (!row.type){
				row.type = $scope.DEFAULT;
			}

			
			var errorMsg = Array();
			if (!row.label) {
				errorMsg.push("Please specify a name for the Bookmark");
			}
			if (!row.url) {
				errorMsg.push("Please specify a url for the Bookmark");
			}
			
			if (errorMsg.length >0){
				var modalInstance = $uibModal.open({
				  animation: $scope.animationsEnabled,
				  templateUrl: 'partials/errorTemplate.html',
				  controller: 'errorCtrl',
				  resolve: {
					items: function () {
					  return errorMsg;
					}
				  }
				});
				return;
			}
			
			
			var params = {
					userID:$scope.userID, 
					url: row.url,
					type: row.typeName,
					label: row.label
				};
			if (row.bookmarkID){
				params.bookmarkID = row.bookmarkID;
			}
			$http({
				method: 'POST',
				url: '/service/saveBookmark.php',
				params: params
				
			}).then(function successCallback(response) {
				$scope.getBookmarks($scope.userID);
				$scope.getTypes();
			  }, function errorCallback(response) {			
			});
		}
		
		$scope.getTypes = function() {
			$http({
				method: 'GET',
				url: '/service/getTypes.php'
			}).then(function successCallback(response) {
				$scope.types = response.data;
				$scope.types.unshift({typeName:"All Types"});
			  }, function errorCallback(response) {			
			});
		}
		
		$scope.newRow = function () {
			$scope.bookmarks.push({url:"", label:"", typeName:"Default"});
		}
		
		$scope.deleteBookmark = function (bookmark) {
			if (bookmark.bookmarkID){
				$http({
					method: 'GET',
					url: '/service/deleteBookmark.php',
					params: {bookmarkID: bookmark.bookmarkID}
				}).then(function successCallback(response) {
					$scope.bookmarks.splice($scope.bookmarks.indexOf(bookmark),1);
				}, function errorCallback(response) {								
				});
			}else {
				$scope.bookmarks.splice($scope.bookmarks.indexOf(bookmark),1);
			}
			
		}
		
		$scope.applyTypeFilter = function (typeName) {
			$scope.typeFilter = (typeName == "All Types") ? "" : typeName;
		}
		
		$scope.applySort = function (column) {
			var exists = $scope.sortOn.indexOf(column);
			if (exists == 0) {
				$scope.sortOn = "-" + column;
			} else {
				$scope.sortOn = column;
			}
		}
		
		$http({
			method: 'GET',
			url: '/service/getUserID.php',
			params: {'userLogin':$scope.currentUser}
		}).then(function successCallback(response) {
			$scope.userID = response.data.userID;			
			$scope.getBookmarks($scope.userID);
			$scope.getTypes();
		  }, function errorCallback(response) {			
		  });
		
		
	}
]);