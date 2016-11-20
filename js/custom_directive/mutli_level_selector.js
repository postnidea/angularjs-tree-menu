angular.module('multi_level_selector', [])

.directive('multiLevelMenu', function() {
  return {
     templateUrl: 'partials/mutli_level_template.html'
  };
})

.controller('mutli_level_controller',['$scope','$resource','$attrs',
	function($scope, $resource, $attrs)
	{

			$scope.servicePath = $attrs.service;
			var Categories = $resource($scope.servicePath,
			 {id:'@id'}, {
			  charge: {method:'POST', params:{charge:true}}
			 });
			$scope.category_selected = "Category Selected";
			$scope.toggle_multi_level = false;

			/*$scope.first_level =[
					{category_name:'Vegitables', id:1},
					{category_name:'Dairy Products', id:2},
					{category_name:'Farm Products.', id:3}
			];

			$scope.second_level =[
					{category_name:'Beans', id:1, contain_levels:0},
					{category_name:'Couli Flower', id:2,contain_levels:0},
					{category_name:'Tomato', id:3 ,contain_levels:1},
					{category_name:'Brinjal', id:4,contain_levels:0}
			]; */

			$scope.current_level = 0;
			$scope.changeId = function(id, has_childs,category_name){
			
			
			
			
				$scope.current_level = id;
				
				
				if(has_childs == 0){
					console.log(category_name);
					console.log("hello");
				} else {
				$scope.refreshMenu();
				}
				
				if(has_childs == 0)
				{
					$scope.toggle_multi_level=false;
					$scope.category_selected = category_name;
				}
			}

			
			
			$scope.refreshMenu = function()
			{
					
			//	$scope.first_level = [];
			//	$scope.second_level = [];
				var c_category = "";
				var open_flag=0;
				if(c_category.length>0){
					console.log(c_category);
					$scope.current_level=parseInt(c_category);
					open_flag=1;
				} 
				
				Categories.get({id:$scope.current_level}).$promise.then(function(category_data) {
	     		 $scope.second_level = category_data.categories;
	     		 $scope.first_level = category_data.parents;
	     		 });
			}
			$scope.refreshMenu();

	}]);


function option_selected(obj){

 var cl =  $(obj).find('span').attr('class').split(' ');

	if($(".list-group").find(".glyphicon-ok").length>0){
		$(".list-group").find(".glyphicon-ok").addClass("glyphicon-plus ng-hide");
		$(".list-group").find(".glyphicon-ok").removeClass("glyphicon-ok");
		
	
	}
  
  if(cl.indexOf("ng-hide")!= -1){
  
	
	  $(obj).find('span').addClass("glyphicon-ok");
      $(obj).find('span').removeClass("glyphicon-plus ng-hide"); 
  }
  
}
	

