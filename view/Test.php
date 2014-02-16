<html>
<head>
	<link rel="stylesheet" href="../libs/PrimePhp/primeui-1.0/production/jquery-ui.css" />
	<link rel="stylesheet" href="../libs/PrimePhp/primeui-1.0/themes/afterdark/theme.css" />
	<link rel="stylesheet" href="../libs/PrimePhp/primeui-1.0/development/primeui-1.0.css" />
	<script type="text/javascript" src="../libs/PrimePhp/primeui-1.0/production/jquery.js"></script>  
	<script type="text/javascript" src="../libs/PrimePhp/primeui-1.0/production/jquery-ui.js"></script>
	<script type="text/javascript" src="../libs/PrimePhp/primeui-1.0/development/primeui-1.0.js"></script>
</head>
<body>
<script type="text/javascript">  
    $(function() {  
        $('#tbllocal').puidatatable({  
            caption: 'Local Datasource',  
            paginator: {  
                rows: 5  
            },  
            columns: [  
                {field:'vin', headerText: 'Vin', sortable:false},  
                {field:'brand', headerText: 'Brand', sortable:false},  
                {field:'year', headerText: 'Year', sortable:false},  
                {field:'color', headerText: 'Color', sortable:false}  
            ],  
            datasource: [  
                {'brand':'<input type="text" />','year': 2012, 'color':'White', 'vin':'dsad231ff'},  
                {'brand':'Audi','year': 2011, 'color':'Black', 'vin':'gwregre345'},  
                {'brand':'Renault','year': 2005, 'color':'Gray', 'vin':'h354htr'},  
                {'brand':'Bmw','year': 2003, 'color':'Blue', 'vin':'j6w54qgh'},  
                {'brand':'Mercedes','year': 1995, 'color':'White', 'vin':'hrtwy34'},  
                {'brand':'Opel','year': 2005, 'color':'Black', 'vin':'jejtyj'},  
                {'brand':'Honda','year': 2012, 'color':'Yellow', 'vin':'g43gr'},  
                {'brand':'Chevrolet','year': 2013, 'color':'White', 'vin':'greg34'},  
                {'brand':'Opel','year': 2000, 'color':'Black', 'vin':'h54hw5'},  
                {'brand':'Mazda','year': 2013, 'color':'Red', 'vin':'245t2s'}  
            ],  
            selectionMode: 'single',  
            rowSelect: function(event, data) {  
                $('#messages').puigrowl('show', [{severity:'info', summary: 'Row Selected', detail: (data.brand + ' ' + data.vin)}]);  
            },  
            rowUnselect: function(event, data) {  
                $('#messages').puigrowl('show', [{severity:'info', summary: 'Row Unselected', detail: (data.brand + ' ' + data.vin)}]);  
            }  
        });  
  
        $('#tblremoteeager').puidatatable({  
            caption: 'Remote Restful Webservice',  
            paginator: {  
                rows: 5  
            },  
            columns: [  
                {field:'vin', headerText: 'Vin', sortable:true},  
                {field:'brand', headerText: 'Brand', sortable:true},  
                {field:'year', headerText: 'Year', sortable:true},  
                {field:'color', headerText: 'Color', sortable:true}  
            ],  
            datasource: function(callback) {  
                $.ajax({  
                    type: "GET",  
                    url: 'rest/cars/list',  
                    dataType: "json",  
                    context: this,  
                    success: function(response) {  
                        callback.call(this, response);  
                    }  
                });  
            },  
            selectionMode: 'multiple',  
            rowSelect: function(event, data) {  
                $('#messages').puigrowl('show', [{severity:'info', summary: 'Row Selected', detail: (data.brand + ' ' + data.vin)}]);  
            },  
            rowUnselect: function(event, data) {  
                $('#messages').puigrowl('show', [{severity:'info', summary: 'Row Unselected', detail: (data.brand + ' ' + data.vin)}]);  
            }  
        });  
  
        $('#tblremotelazy').puidatatable({  
            lazy: true,  
            caption: 'Remote Restful Webservice - Lazy',  
            paginator: {  
                rows: 5,  
                totalRecords: 200  
            },  
            columns: [  
                {field:'vin', headerText: 'Vin', sortable:true},  
                {field:'brand', headerText: 'Brand', sortable:true},  
                {field:'year', headerText: 'Year', sortable:true},  
                {field:'color', headerText: 'Color', sortable:true}  
            ],  
            datasource: function(callback, ui) {  
                var uri = 'rest/cars/lazylist/' + ui.first;  
                if(ui.sortField) {  
                    uri += '/' + ui.sortField + '/' + ui.sortOrder;  
                }  
  
                $.ajax({  
                    type: "GET",  
                    url: uri,  
                    dataType: "json",  
                    context: this,  
                    success: function(response) {  
                        callback.call(this, response);  
                    }  
                });  
            }  
        });  
  
        $('#messages').puigrowl();  
    });  
</script>  

<div id="messages"></div>  
                              
<div id="tbllocal"></div>  
  
<div id="tblremoteeager"></div>  
  
<div id="tblremotelazy"></div>  