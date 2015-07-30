<?php
	// Tatuapé
    $tatu_db = new PDO("pgsql:host=localhost port=5433 dbname=aghu_50 user=postgres password=postgres");
	$tatu_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Jabaquara
    $jaba_db = new PDO("pgsql:host=localhost port=5433 dbname=am0106_hmars user=postgres password=postgres");
	$jaba_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Ermelino
    $erme_db = new PDO("pgsql:host=localhost port=5433 dbname=am0106_hmacn user=postgres password=postgres");
	$erme_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$executa = file_get_contents('sql/historico_internacao.sql');

		$consulta = $jaba_db->query($executa); 
		$monta = "";
		$mes_ano = "";

		$i = 0;

		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
	     	$mes_ano  .=  '[' . $i . ',"' .  $linha['data'] . '"]' . ',';
			$monta    .=  '[' . $i . ',' .  $linha['quantidade'] . ']' . ',';
			$i++;
		}								

		$monta = "[" . substr ($monta, 0, strlen($monta) -1 ) . "]";
		$mes_ano = "[" . substr ($mes_ano, 0, strlen($mes_ano) -1 ) . "]";
?>




<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Painel SIG - Sistema de Informações Gerenciais</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/metro.css" rel="stylesheet" />
	<link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/teste/examples.css" rel="stylesheet" />
	<link href="assets/css/style_responsive.css" rel="stylesheet" />
	<link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
	<link rel="stylesheet" type="text/css" href="assets/chosen-bootstrap/chosen/chosen.css" />
	<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
	<link rel="shortcut icon" href="favicon.ico" />
    <script src="assets/teste/jquery.js"></script>        
    <script src="assets/teste/jquery.flot.js"></script>
    <script src="assets/teste/jquery.flot.categories.js"></script>    
    
    
      <link   rel="stylesheet" href="tree/css/jquery.treetable.css" />
      <link   rel="stylesheet" href="tree/css/jquery.treetable.theme.default.css" />
      <script src="tree/css/jquery.treetable.js"></script>
      <script src="tree/css/jquery-1.11.3.js"></script>    
    

	<script type="text/javascript">
		var data = [[48803, "DSK1", "", "02200220", "OPEN"], [48769, "APPR", "", "77733337", "ENTERED"]];

		var subgridData = [[1,"Item 1",3],[2,"Item 2",5]];

		var globalSubGridNames = [];
		    
		$("#grid_teste").jqGrid({
		    datatype: "local",
		    height: 250,
		    colNames: ['Inv No', 'Thingy', 'Blank', 'Number', 'Status'],
		    colModel: [{
		        name: 'id',
		        index: 'id',
		        width: 60,
		        sorttype: "int"},
		    {
		        name: 'thingy',
		        index: 'thingy',
		        width: 90,
		        sorttype: "date"},
		    {
		        name: 'blank',
		        index: 'blank',
		        width: 30},
		    {
		        name: 'number',
		        index: 'number',
		        width: 80,
		        sorttype: "float"},
		    {
		        name: 'status',
		        index: 'status',
		        width: 80,
		        sorttype: "float"}
		    ],
		    pager: 'pagerId',
		    caption: "Stack Overflow Subgrid Example",
		    subGrid: true,
		    subGridOptions: { "plusicon" : "ui-icon-triangle-1-e",
		                      "minusicon" :"ui-icon-triangle-1-s",
		                      "openicon" : "ui-icon-arrowreturn-1-e",
		                      "reloadOnExpand" : false,
		                      "selectOnExpand" : true },
		    subGridRowExpanded: function(subgrid_id, row_id) {
		        var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t";
		        pager_id = "p_"+subgrid_table_id;
		        $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
		        $("#"+subgrid_table_id).jqGrid({
		            datatype: "local",
		            colNames: ['No','Item','Qty'],
		            colModel: [ {name:"num",index:"num",width:80,key:true},
		                        {name:"item",index:"item",width:130},
		                        {name:"qty",index:"qty",width:70,align:"right"}], 
		            rowNum:20,
		            pager: pager_id,
		            sortname: 'num',
		            sortorder: "asc", height: '100%' });
		         $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false});
		        
		         var subNames = ["num", "item", "qty"];
		         var mysubdata = [];
		         for (var i = 0; i < subgridData.length; i++) {
		            mysubdata[i] = {};
		            for (var j = 0; j < subgridData[i].length; j++) {
		                mysubdata[i][subNames[j]] = subgridData[i][j];
		             }
		         }
		         for (var i = 0; i <= mysubdata.length; i++) {
		           $("#"+subgrid_table_id).jqGrid('addRowData', i + 1, mysubdata[i]);
		         }
		    }
		});

		var names = ["id", "thingy", "blank", "number", "status"];
		var mydata = [];

		for (var i = 0; i < data.length; i++) {
		    mydata[i] = {};
		    for (var j = 0; j < data[i].length; j++) {
		        mydata[i][names[j]] = data[i][j];
		    }
		}

		for (var i = 0; i <= mydata.length; i++) {
		    $("#grid").jqGrid('addRowData', i + 1, mydata[i]);
		}



		$("#grid").jqGrid('setGridParam', {ondblClickRow: function(rowid,iRow,iCol,e){alert('double clicked');}});

	</script>


    <script type="text/javascript">       
		$(function() {

			// var data = [ ["Fev/2015", 10], ["Mar/2015", 8], ["Abr/2015", 4], ["Mai/2015", 13], ["Jun/2015", 17], ["Jul/2015", 9] ];

		    // var series = {data: [[0, 5.2], [1, 3], [2, 9.2], [3, 10]],
		    var series = {data: <?= $monta ?>,
		                  lines: {show: false},
		                  bars: {show: true, barWidth: 0.75, align:'center'}}
		   
		    somePlot = $.plot("#placeholder1", [ series ], {
		        xaxis: {
		            // ticks: [[0,"One"],[1,"Two"], [2,"Three"],[3,"Four"]]
		            ticks: <?= $mes_ano ?>
		            
		        }
		    });
		    
		    var ctx = somePlot.getCanvas().getContext("2d");
		    var data = somePlot.getData()[0].data;
		    var xaxis = somePlot.getXAxes()[0];
		    var yaxis = somePlot.getYAxes()[0];
		    var offset = somePlot.getPlotOffset();
		    ctx.font = "13px 'Arial'";
		    ctx.fillStyle = "black";
		    for (var i = 0; i < data.length; i++){
		        var text = data[i][1] + '';
		        var metrics = ctx.measureText(text);
		        var xPos = (xaxis.p2c(data[i][0])+offset.left) - metrics.width/2;
		        var yPos = yaxis.p2c(data[i][1]) + offset.top - 5;
		        ctx.fillText(text, xPos, yPos);
		    }
		});        
    </script>


    
    
    <script type="text/javascript">

		$(function() {

			var data = [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ];

			$.plot("#placeholder2", [ data ], {
				series: {
					bars: {
						show: true,
						barWidth: 0.6,
						align: "center"
					}
				},
				xaxis: {
					mode: "categories",
					tickLength: 10
		                            
				},
				yaxis: {
		                            tickLength: 10
		                            
					}	                    
		                    
				});
		});
	</script>        
        
        
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="index.html">
				<img src="assets/img/logo.png" alt="logo" />
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->				
				<!-- BEGIN TOP NAVIGATION MENU -->					
				<ul class="nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->	
					<li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-warning-sign"></i>
						<span class="badge">6</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>You have 14 new notifications</p>
							</li>
							<li>
								<a href="#">
								<span class="label label-success"><i class="icon-plus"></i></span>
								New user registered. 
								<span class="time">Just now</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-important"><i class="icon-bolt"></i></span>
								Server #12 overloaded. 
								<span class="time">15 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-warning"><i class="icon-bell"></i></span>
								Server #2 not respoding.
								<span class="time">22 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-info"><i class="icon-bullhorn"></i></span>
								Application error.
								<span class="time">40 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-important"><i class="icon-bolt"></i></span>
								Database overloaded 68%. 
								<span class="time">2 hrs</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-important"><i class="icon-bolt"></i></span>
								2 user IP blocked.
								<span class="time">5 hrs</span>
								</a>
							</li>
							<li class="external">
								<a href="#">See all notifications <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelope-alt"></i>
						<span class="badge">5</span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p>You have 12 new messages</p>
							</li>
							<li>
								<a href="#">
								<span class="photo"><img src="./assets/img/avatar2.jpg" alt="" /></span>
								<span class="subject">
								<span class="from">Lisa Wong</span>
								<span class="time">Just Now</span>
								</span>
								<span class="message">
								Vivamus sed auctor nibh congue nibh. auctor nibh
								auctor nibh...
								</span>  
								</a>
							</li>
							<li>
								<a href="#">
								<span class="photo"><img src="./assets/img/avatar3.jpg" alt="" /></span>
								<span class="subject">
								<span class="from">Richard Doe</span>
								<span class="time">16 mins</span>
								</span>
								<span class="message">
								Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
								auctor nibh...
								</span>  
								</a>
							</li>
							<li>
								<a href="#">
								<span class="photo"><img src="./assets/img/avatar1.jpg" alt="" /></span>
								<span class="subject">
								<span class="from">Bob Nilson</span>
								<span class="time">2 hrs</span>
								</span>
								<span class="message">
								Vivamus sed nibh auctor nibh congue nibh. auctor nibh
								auctor nibh...
								</span>  
								</a>
							</li>
							<li class="external">
								<a href="#">See all messages <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<li class="dropdown" id="header_task_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-tasks"></i>
						<span class="badge">5</span>
						</a>
						<ul class="dropdown-menu extended tasks">
							<li>
								<p>You have 12 pending tasks</p>
							</li>
							<li>
								<a href="#">
								<span class="task">
								<span class="desc">New release v1.2</span>
								<span class="percent">30%</span>
								</span>
								<span class="progress progress-success ">
								<span style="width: 30%;" class="bar"></span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
								<span class="desc">Application deployment</span>
								<span class="percent">65%</span>
								</span>
								<span class="progress progress-danger progress-striped active">
								<span style="width: 65%;" class="bar"></span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
								<span class="desc">Mobile app release</span>
								<span class="percent">98%</span>
								</span>
								<span class="progress progress-success">
								<span style="width: 98%;" class="bar"></span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
								<span class="desc">Database migration</span>
								<span class="percent">10%</span>
								</span>
								<span class="progress progress-warning progress-striped">
								<span style="width: 10%;" class="bar"></span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
								<span class="desc">Web server upgrade</span>
								<span class="percent">58%</span>
								</span>
								<span class="progress progress-info">
								<span style="width: 58%;" class="bar"></span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
								<span class="desc">Mobile development</span>
								<span class="percent">85%</span>
								</span>
								<span class="progress progress-success">
								<span style="width: 85%;" class="bar"></span>
								</span>
								</a>
							</li>
							<li class="external">
								<a href="#">See all tasks <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
					<!-- END TODO DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img alt="" src="assets/img/avatar1_small.jpg" />
						<span class="username">Bob Nilson</span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="extra_profile.html"><i class="icon-user"></i> My Profile</a></li>
							<li><a href="calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
							<li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
							<li class="divider"></li>
							<li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU -->	
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->	
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        	
			<ul>
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />				
							<input type="button" class="submit" value=" " />
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start ">
					<a href="index.html">
					<i class="icon-home"></i> 
					<span class="title">Dashboard</span>
					</a>
				</li>
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">UI Features</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="ui_general.html">General</a></li>
						<li ><a href="ui_buttons.html">Buttons</a></li>
						<li ><a href="ui_tabs_accordions.html">Tabs & Accordions</a></li>
						<li ><a href="ui_sliders.html">Sliders</a></li>
						<li ><a href="ui_tiles.html">Tiles</a></li>
						<li ><a href="ui_typography.html">Typography</a></li>
						<li ><a href="ui_tree.html">Tree View</a></li>
						<li ><a href="ui_nestable.html">Nestable List</a></li>
					</ul>
				</li>
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-table"></i> 
					<span class="title">Form Stuff</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="form_layout.html">Form Layouts</a></li>
						<li ><a href="form_samples.html">Advance Form Samples</a></li>
						<li ><a href="form_component.html">Form Components</a></li>
						<li ><a href="form_wizard.html">Form Wizard</a></li>
						<li ><a href="form_validation.html">Form Validation</a></li>
						<li ><a href="form_fileupload.html">Multiple File Upload</a></li>
						<li ><a href="form_dropzone.html">Dropzone File Upload</a></li>
					</ul>
				</li>
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-th-list"></i> 
					<span class="title">Data Tables</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="table_basic.html">Basic Tables</a></li>
						<li ><a href="table_managed.html">Managed Tables</a></li>
						<li ><a href="table_editable.html">Editable Tables</a></li>
					</ul>
				</li>
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-th-list"></i> 
					<span class="title">Portlets</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="portlet_general.html">General Portlets</a></li>
						<li ><a href="portlet_draggable.html">Draggable Portlets</a></li>
					</ul>
				</li>
				<li class="has-sub ">
					<a href="javascript:;">
					<i class="icon-map-marker"></i> 
					<span class="title">Maps</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub">
						<li ><a href="maps_google.html">Google Maps</a></li>
						<li ><a href="maps_vector.html">Vector Maps</a></li>
					</ul>
				</li>
				<li class="">
					<a href="charts.html">
					<i class="icon-bar-chart"></i> 
					<span class="title">Visual Charts</span>
					</a>
				</li>
				<li class="">
					<a href="calendar.html">
					<i class="icon-calendar"></i> 
					<span class="title">Calendar</span>
					</a>
				</li>
				<li class="">
					<a href="gallery.html">
					<i class="icon-camera"></i> 
					<span class="title">Gallery</span>
					</a>
				</li>
				<li class="active has-sub ">
					<a href="javascript:;">
					<i class="icon-briefcase"></i> 
					<span class="title">Extra</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<ul class="sub">
						<li ><a href="extra_profile.html">User Profile</a></li>
						<li ><a href="extra_faq.html">FAQ</a></li>
						<li ><a href="extra_search.html">Search Results</a></li>
						<li ><a href="extra_invoice.html">Invoice</a></li>
						<li ><a href="extra_pricing_table.html">Pricing Tables</a></li>
						<li ><a href="extra_404.html">404 Page</a></li>
						<li ><a href="extra_500.html">500 Page</a></li>
						<li class="active"><a href="extra_blank.html">Blank Page</a></li>
						<li ><a href="extra_full_width.html">Full Width Page</a></li>
					</ul>
				</li>
				<li class="">
					<a href="login.html">
					<i class="icon-user"></i> 
					<span class="title">Login Page</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<div class="color-mode">
								<p>THEME COLOR</p>
								<ul class="inline">
									<li class="color-black current color-default" data-style="default"></li>
									<li class="color-blue" data-style="blue"></li>
									<li class="color-brown" data-style="brown"></li>
									<li class="color-purple" data-style="purple"></li>
									<li class="color-white color-light" data-style="light"></li>
								</ul>
								<label class="hidden-phone">
								<input type="checkbox" class="header" checked value="" />
								<span class="color-mode-label">Fixed Header</span>
								</label>							
							</div>
						</div>
						<!-- END BEGIN STYLE CUSTOMIZER --> 
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							Painel SIG - 			<small>Sistema de Informações Gerenciais</small> 
						</h3>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
                                    <div class="span7" style="width: 69%">
                                            <!-- BEGIN INLINE TABS PORTLET-->
                                            <div class="portlet box green">
                                                    <div class="portlet-title">
                                                            <h4><i class="icon-reorder"></i>Internações</h4>
                                                            <div class="tools">
                                                                    <a href="javascript:;" class="collapse"></a>
                                                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                                            </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                            <div class="row-fluid">
                                                                    <div class="span8">
                                                                            <!--BEGIN TABS-->
                                                                            <div class="tabbable tabbable-custom">
                                                                                    <ul class="nav nav-tabs">
                                                                                            <li class="active"><a href="#tab_1_1" data-toggle="tab">Histórico de Internação</a></li>
                                                                                            <li class=""><a href="#tab_1_2" data-toggle="tab">Histórico de Altas</a></li>
                                                                                    </ul>
                                                                                    <div class="tab-content">
                                                                                            <div class="tab-pane active" id="tab_1_1">
                                                                                                <!-- 
                                                                                                	<div class="demo-container1">
                                                                                                    	    <div id="placeholder1" class="demo-placeholder1"></div>
                                                                                                	</div>                                                                                                
                                                                                                -->

                                                                                                <div id="placeholder1" style="width:600px;height:300px"></div>

                                                                                            </div>
                                                                                        
                                                                                            <div class="tab-pane" id="tab_1_2">
                                                                                                
                                                                                                <div class="demo-container2">
                                                                                                        <div id="placeholder2" class="demo-placeholder2"></div>
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                    </div>
                                                                            </div>
                                                                            <!--END TABS-->
                                                                    </div>
                                                                
                                                                    <div class="span4 responsive" data-tablet="span6" data-desktop="span4">
                                                                        <!-- <a class="btn purple big">pricing options <i class="m-icon-big-swapright m-icon-white"></i></a> -->

                                                                        
                                                                        <div class="dashboard-stat green">
                                                                                
                                                                                    <a class="more" href="#">
                                                                                         <h1>2.341</h1>
                                                                                         
                                                                                          <h5>
                                                                                                Pacientes internados agora
                                                                                            </h5>
                                                                                         <i class="m-icon-swapright m-icon-white"></i>
                                                                                    </a>                                                                                                    
                                                                                
                                                                        </div>
                                                                           
                                                                    </div>
                                                            </div>
                                  
                                                        
                                                        
                                                        
                                                    </div>
                                            </div>
                                            <!-- END INLINE TABS PORTLET-->
                                    </div>

                                    
                                    <div class="span5" style="width: 30%;margin-left:10px">
                                            <!-- BEGIN INLINE TABS PORTLET-->
                                            <div class="portlet box green">
                                                    <div class="portlet-title">
                                                            <h4><i class="icon-reorder"></i>Detalhes</h4>
                                                            <div class="tools">
                                                                    <a href="javascript:;" class="collapse"></a>
                                                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                                            </div>
                                                    </div>
                                                    <div class="portlet-body">

                                                                <div id="main">
                                                                   <table id="example-advanced" class="table table-hover">
                                                                      <caption>
                                                                         <a href="#" onclick="jQuery('#example-advanced').treetable('expandAll'); return false;">Expandir</a>
                                                                         <a href="#" onclick="jQuery('#example-advanced').treetable('collapseAll'); return false;">Recolher</a>
                                                                      </caption>
                                                                      <thead>
                                                                         <tr>
                                                                            <th>Hospital/Especialidade/Unidade</th>
                                                                            <th>Quantidade</th>
                                                                         </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                         <tr data-tt-id='2'>
                                                                            <td><span class='folder'>Tatuapé</span></td>
                                                                            <td>8000</td>
                                                                         </tr>
                                                                         <tr data-tt-id='2-1' data-tt-parent-id='2'>
                                                                            <td><span class='folder'>Ginecologia</span></td>
                                                                            <td>5000</td>
                                                                         </tr>
                                                                         <tr data-tt-id='2-1-1' data-tt-parent-id='2-1'>
                                                                            <td><span class='file'>Unidade1</span></td>
                                                                            <td>5000</td>
                                                                         </tr>
                                                                         <tr data-tt-id='2-2' data-tt-parent-id='2'>
                                                                            <td><span class='folder'>Neonatalogia</span></td>
                                                                            <td>1500</td>
                                                                         </tr>
                                                                         <tr data-tt-id='2-2-1' data-tt-parent-id='2-2'>
                                                                            <td><span class='file'>Unidade 2</span></td>
                                                                            <td>1500</td>
                                                                         </tr>
                                                                         <tr data-tt-id='2-3' data-tt-parent-id='2'>
                                                                            <td><span class='folder'>Centro Obstétrico</span></td>
                                                                            <td>1500</td>
                                                                         </tr>
                                                                         <tr data-tt-id='2-3-1' data-tt-parent-id='2-3'>
                                                                            <td><span class='file'>Unidade 3</span></td>
                                                                              <td>1500</td>
                                                                         </tr>
                                                                         <tr data-tt-id='3'>
                                                                            <td><span class='folder'>Ermelino</span></td>
                                                                            <td>4000</td>
                                                                         </tr>
                                                                         <tr data-tt-id='3-1' data-tt-parent-id='3'>
                                                                            <td><span class='folder'>Especialidade A</span></td>
                                                                            <td>2000</td>
                                                                         </tr>
                                                                         <tr data-tt-id='3-2' data-tt-parent-id='3'>
                                                                            <td><span class='folder'>Especialidade B</span></td>
                                                                            <td>2000</td>
                                                                         </tr>
                                                                         <tr data-tt-id='5'>
                                                                            <td><span class='folder'>Jabaquara</span></td>
                                                                            <td>1000</td>
                                                                         </tr>
                                                                         <tr data-tt-id='5-1' data-tt-parent-id='5'>
                                                                            <td><span class='folder'>Especialidade C</span></td>
                                                                            <td>500</td>
                                                                         </tr>
                                                                         <tr data-tt-id='5-1' data-tt-parent-id='5'>
                                                                            <td><span class='folder'>Especialidade D</span></td>
                                                                            <td>500</td>
                                                                         </tr>


                                                                      </tbody>
                                                                   </table>
                                                                </div>                                                                



                                                    </div>
                                            </div>
                                            <!-- END INLINE TABS PORTLET-->
                                    </div>
                                    
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->	
		</div>
		<!-- END PAGE -->	 	
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		2013 &copy; Metronic by keenthemes.
		<div class="span pull-right">
			<span class="go-top"><i class="icon-angle-up"></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS -->
	<!-- Load javascripts at bottom, this will reduce page load time -->
	<script src="assets/js/jquery-1.8.3.min.js"></script>			
	<script src="assets/breakpoints/breakpoints.js"></script>			
	<script src="assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.blockui.js"></script>
	<script src="assets/js/jquery.cookie.js"></script>
	<script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>	
	<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
        
        <script src="assets/teste/jquery.flot.js"></script>
        <script src="assets/teste/jquery.flot.categories.js"></script>                
	<script src="assets/flot/jquery.flot.resize.js"></script>
	<script src="assets/flot/jquery.flot.pie.js"></script>
	<script src="assets/flot/jquery.flot.stack.js"></script>
	<script src="assets/flot/jquery.flot.crosshair.js"></script>
        
        
      <script src="tree/jquery.treetable.js"></script>
      <script>
         $("#example-advanced").treetable({ expandable: true });
      </script>        
        
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src="assets/js/excanvas.js"></script>
	<script src="assets/js/respond.js"></script>
	<![endif]-->
	<script src="assets/js/app.js"></script>		
	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage('calendar');
			App.init();
		});
	</script>
        
	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.setPage('charts');
			App.init();
		});
	</script>
        
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
