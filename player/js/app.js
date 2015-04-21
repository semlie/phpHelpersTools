/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function() {
    var url = "http://api.yaelzals.co.il/";
    var app = angular.module('videoApp', ["ngRoute"]);
    app.controller('videoPlayer', ["$scope", "videoData", function($scope, videoData) {
            videoData.data("time-management").then(function(items) {
                $scope.videoList = items.data;
            });
            console.log($scope, "videoApp");
        }]);
    app.factory('videoData', ["$http", function($http) {
            var d, get = function(path, userId) {
                return  $http.get(url+"video/" + path + "/" + userId).success(function(data) {
                    // prepare data here
                    d = data;
                });
            }
            return {data: get, results: d
            }

        }]);

    app.controller('videoSection', ["$scope", "$routeParams", "videoData", "vid", function($scope, $routeParams, videoData, vid) {
            console.log(vid, "vid");
//            videoData.data("time-management", function(data) {
            $scope.videoList = vid.data;
            console.log($routeParams.videoId);
            console.log($scope);
            $scope.video = _.where(vid.data, {videoId: parseInt($routeParams.videoId)})[0];
            console.log($scope.video);
//            });
//           $scope.videoList = _.filter(videos,function(v){
//                if (v.day<=$routeParams.videoId)
//                    return true;
//                else return false;
//            
            //   console.log(videos);

        }]);
    app.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
                    when('/video/:videoId', {
                        templateUrl: 'partial/video-section.html',
                        controller: 'videoSection',
                        resolve: {
                            vid: function(videoData) {
                                return videoData.data("time-management");
                            }
                        }
                    }).
                    when('/showOrders', {
                        templateUrl: 'partial/show-orders.html',
                        controller: 'ShowOrdersController'
                    }).
                    otherwise({
                        redirectTo: '/video/1'
                    });
        }]);
    app.filter('trusted', ['$sce', function($sce) {
            return function(url) {
                return $sce.trustAsResourceUrl(url);
            };
        }]);
})();