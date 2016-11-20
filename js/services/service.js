var crudService = angular.module('crudService',[]);




// Finding all the templates which are available online and then updating the local repo. 
crudService.factory('template_api' , function($http) {
	return {
		getAllTemplates : function(api_path)
		{
			
					data = $http.get(api_path + 'widgetcreator_fetch.php?per_page=100');
					return data;
		},

		getSingleTemplates : function(api_path,widget_id)
		{
				// Looping all the available 
				console.log("Service Call" + api_path + 'fetch_widgets_vars.php?widget_id=' + widget_id);
				data = $http.get(api_path + 'fetch_widgets_vars.php?widget_id=' + widget_id);
				return data;
		}, 
		getCodeFromAPI : function(api_path,widget_id,wizard_data)
		{
				// Looping all the available 
				console.log("Service Call" + api_path + 'fetch_widgets_vars.php?widget_id=' + widget_id);
				data = $http.get(api_path + 'fetch_widgets_vars.php?widget_id=' + widget_id);
				return data;
		}

	}
});




crudService.factory('userdata',function($http){
	return {
		alldata : function(){
			data = $http.get('phpservice/table_services.php?route=ListAllTables');
			return data;
		}, 

		delete : function(idx){
			data = $http.post('phpservice/table_services.php?route=deleteJSON',{'table_id':idx});
			return data;
		},

		add_table : function(data_to_push){
			if(data_to_push.id=="")
			{
					data = $http.post('phpservice/table_services.php?route=createTableJSON',data_to_push);
					return data;
			}
			else
			{
				data = $http.post('phpservice/table_services.php?route=updateTableJSON',data_to_push);
				return data;

			}
		}

	}
});

// Service for the Table fields. 
crudService.factory('table_field_service',function($http){
	return {
		alldata : function(){
			data = $http.get('phpservice/data_service_table_fields.php?route=ListAllTables');
			return data;
		}, 

		delete : function(idx){
			data = $http.post('phpservice/data_service_table_fields.php?route=deleteJSON',{'table_id':idx});
			return data;
		},

		getById : function(table_id){
			data = $http.post('phpservice/data_service_table_fields.php?route=GetById',{table_id:table_id});
			return data;
		},

		update_all : function(recordset){
			data = $http.post('phpservice/data_service_table_fields.php?route=UpdateAll',recordset);
			return data;
		},


		add_table : function(data_to_push){
			if(data_to_push.id=="")
			{
					data = $http.post('phpservice/data_service_table_fields.php?route=createTableJSON',data_to_push);
					return data;
			}
			else
			{
				data = $http.post('phpservice/data_service_table_fields.php?route=updateTableJSON',data_to_push);
				return data;

			}
		}

	}
});
