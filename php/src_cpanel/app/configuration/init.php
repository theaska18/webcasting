<?php
  $content="
    {
      xtype:'panel',
      id:'app_coniguration',
      border:false,
      padding:true,
      title:'Configuration',
      bodyBorder:false,
      items:[
        {
          xtype:'toolbar',
          border:false,
          layout: {
              overflow: 'scroller'
          },
          items:[
          
            {
              iconCls: 'x-fa fa-filter',
              margin:false,
              xtype:'button',
              border:'1 0 1 1',
            },{
              xtype:'textfield',
              width: 200,
              margin:false,
              emptyText: 'Search...',
            },{
              iconCls: 'x-fa fa-search',
              xtype:'button',
              border:'1 1 1 0',
            },'-',{
              text:'Create New',
              border:true,
              iconAlign: 'right',
              iconCls: 'x-fa fa-plus',
            }
          ]
        },{
        xtype: 'gridpanel',
        margin:true,

     

        columns: [{
            text: 'Config Code',
            dataIndex: 'code',
            width:150,
            
            sortable: true
        }, {
            text: 'Config Name',
            dataIndex: 'name',

            width: 250,
            sortable: true
        }, {
            text: 'Value',
            dataIndex: 'value',
            flex: 1,
            minWidth:250,
            sortable: false
        }]
    }
      ]
    }
  ";

?>