<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="mobile-web-app-capable" content="yes">
	<title>Welcome to CodeIgniter</title>
	<link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/logo1.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style>
		#load{
			width:100%;
			height:100%;
			position:fixed;
			z-index:9999;
			background:url("<?php echo base_url(); ?>assets/cpanel/loading.gif") no-repeat center center white
		}
	</style>
	<script>
		document.onreadystatechange = function () {
		  var state = document.readyState
		  if (state == 'interactive') {
		  } else if (state == 'complete') {
			  setTimeout(function(){
				 $('#load').fadeOut('slow');
			  },1000);
		  }
		}
	</script>
</head>
<body style="margin:0px;">
	<div id="load"></div>
	<div id="content">
		<?= $contentType=='html'? $content : ''  ?>
	</div>
	<div id="main"></div>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/ext-7.0.0/build/classic/theme-triton/resources/theme-triton-all.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/cpanel.css?v=1">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/ext-7.0.0/build/ext-all.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-4.0.0.min.js"></script>
	<script type="text/javascript">
		var menuLeftEmpty=<?= $menuLeft==''?'true':'false'; ?>;
		function loadPage(){

		}
		$(function(){});
		Ext.Loader.setConfig({
			enabled: true,
			paths: {
				'App': 'app'
			}
		});
		Ext.application({
			name: 'App',
			launch: function() {
				
				var isMobile = window.innerWidth <= 768;
				var menuVisible = !isMobile;
				var buttonMenuBack=Ext.create('Ext.Button',{
					xtype: 'button',
					text:'Back',
					iconCls: 'x-fa fa-chevron-left',
					handler: function() {
						menuPanel.hide();
						menuHoverPanel.hide();
					}
				});
				var menuPanel = Ext.create('Ext.Panel', {
					xtype: 'panel',
					width: 250,
					border:false,
					bodyBorder:false,
					cls: 'c-menu ' + (isMobile?'c-menu-mobile':''),
					hidden: menuVisible && !menuLeftEmpty ? false : true,
					bbar:[buttonMenuBack],
					html: '<div style="padding:15px;">' +
						'<ul style="list-style:none; padding:0;">' +
						'<li style="padding:10px 0;">📊 Dashboard</li>' +
						'<li style="padding:10px 0;">⚙️ <a href="javascript:loadPage(\'configuration\');">Configuration</a></li>' +
						'<li style="padding:10px 0;">👥 Users</li>' +
						'<li style="padding:10px 0;">📄 Content</li>' +
						'<li style="padding:10px 0;">🖼️ Media</li>' +
						'</ul></div>'
				});
				var menuHoverPanel = Ext.create('Ext.Panel', {//
					xtype: 'panel',
					id:'menuHoverPanel',
					border:false,
					bodyBorder:false,
					bodyCls:'c-menu-hover-mobile',
					hidden: true
				});
				var contentPanel = Ext.create('Ext.Panel', {
					xtype: 'panel',
					id:'panelContent',
					flex: 1,
					border:false,
					bodyBorder:false,
					bodyPadding:false,
					items:[
						<?= $contentType=='extjs'? $content : ''  ?>
					],
					html:$('#content').html(),
				});
				var buttonMenu=Ext.create('Ext.Button',{
					xtype: 'button',
					iconCls: 'x-fa fa-bars',
					hidden: menuVisible || menuLeftEmpty ? true : false,
					style: {
						width: '50px', 
						height: '50px',
					},
					handler: function() {
						menuPanel.show({
							type: 'slide',
							direction: 'right',
							duration: 400
						});
						menuHoverPanel.show();
					}
				});
				var iconBigPanel = Ext.create('Ext.Panel', {
					width: 250,
					flex:1,
					id:"logo2",
					// bodyStyle: {
					// 	height: '50px',
					// },
					hidden: menuVisible ? false : true,
					border:false,
					bodyBorder:false,
					html: '<div style="display: flex;align-items: center;margin-top: 5px;"><img style="height: 40px;margin-left: 10px;" src="<?= base_url(); ?>assets/images/logo1.png"><img style="height: 40px;margin-left: 10px;" src="<?= base_url(); ?>assets/images/logo_title.png"></div>'
				});
				var iconBigPanelCenter = Ext.create('Ext.Panel', {
					id:"logo1",
					hidden: menuVisible ? true : false,
					border:false,
					flex:1,
					height:50,
					bodyBorder:false,
					html: '<img style="height: 40px;margin-top:5px;" src="<?= base_url(); ?>assets/images/logo_title.png">'
				});
				var headerPanel=Ext.create('Ext.Panel',{
					layout: 'hbox',
					width: '100%',
					height:50,
					id:"logo3",
					// bodyStyle: {
					// 	height: '50px',
					// },
					//scrollable:true,
					border:false,
					bodyBorder:false,
					items: [
						iconBigPanel, 
						{
							xtype:'panel',
							flex:1,
							border:false,
							bodyBorder:false,
							layout: 'hbox',
							items:[
								buttonMenu,
								{
									xtype:'panel',
									border:false,
									bodyBorder:false,
									flex:1
								},
								iconBigPanelCenter,
								{
									xtype:'panel',
									border:false,
									bodyBorder:false,
									flex:1,
								}
							]
						}
					]
				});
				var copyRightPanel=Ext.create('Ext.Panel',{
					height: 40,
					border:false,
					bodyBorder:false,
					width: '100%',
					style: {
						backgroundColor: '#2c3e50',
					//	borderTop: '1px solid #1a252f'
					},
					html: '<div style="padding:10px; text-align:center; color:#95a5a6; font-size:12px;">&copy; 2026 CKamal CMS - Powered by Asep Kamaludin</div>'
				});
				var mainPanel = Ext.create('Ext.container.Viewport', {
					width: '100%',
					renderTo: 'main',
					minHeight: window.innerHeight,
					scrollable: true,
					layout: 'vbox',
					style: {
						background: 'white'
					},
					id:'mainPanell',
					border:false,
					bodyBorder:false,
					items: [
						headerPanel,
						{
							xtype: 'container',
							layout: 'hbox',
							id:'mainPanel',
							bodyBorder:false,
							minHeight: window.innerHeight-40-50,
							width: '100%',
							border:false,
							scrollable:true,
							items: [menuPanel,menuHoverPanel, contentPanel]
						},
						copyRightPanel
					]
				});
				window.addEventListener('resize', function() {
					var width = window.innerWidth;
					if (width <= 768) {
						menuPanel.hide();
						menuPanel.addCls('c-menu-mobile');
						if(menuLeftEmpty==false){
							buttonMenu.show();
						}
						iconBigPanel.hide();
						iconBigPanelCenter.show();
					} else {
						if(menuLeftEmpty==false){
							menuPanel.show();
							menuPanel.removeCls('c-menu-mobile');
							
						}
						
						buttonMenu.hide();
						menuHoverPanel.hide();
						iconBigPanel.show();
						iconBigPanelCenter.hide();
					}
					Ext.getCmp('mainPanel').setMinHeight(window.innerHeight-40-50);
				});
				
				//mainPanel.render('main');
				$('#menuHoverPanel').unbind().bind('click',function(){
					menuPanel.hide();
					menuHoverPanel.hide();
				});
				// headerPanel.setHeight(50);
				iconBigPanel.setHeight(50);
			}
		});
	</script>
</body>
</html>
