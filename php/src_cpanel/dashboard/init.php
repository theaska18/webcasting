<?php
$date = new DateTime('now', new DateTimeZone('UTC'));
$contentType="extjs";
  $content=<<<JS
  Ext.create('Ext.panel.Panel',{
    width: '100%',
    height: 550,
    bodyStyle: {
        background: 'linear-gradient(to bottom, #ffffff 0%, #eef5ff 45%, #dbeeff 50%, #eef5ff 55%, #ffffff 100%)'
    },
    layout: {
        type: 'hbox',
        align: 'stretch'
    },
    items: [{
        xtype: 'container',
        flex: 1,
        padding: 40,
        layout: {
            type: 'vbox',
            align: 'left'
        },
        items: [{
            xtype: 'component',
            html: `
                <div style="
                    font-size:58px;
                    font-weight:800;
                    color:#123E9A;
                    line-height:60px;">
                    Webcasting
                </div>

                <div style="
                    font-size:58px;
                    font-weight:800;
                    color:#ff6b00;
                    margin-top:-8px;">
                    Expert
                </div>

                <div style="
                    margin-top:20px;
                    font-size:20px;
                    color:#333;">
                    Professional • Reliable • Secure • Scalable
                </div>

                <div style="
                    margin-top:30px;
                    font-size:36px;
                    font-weight:bold;
                    color:#123E9A;">
                    All-in-one solution for professional webcasting
                </div>

                <div style="
                    margin-top:15px;
                    font-size:18px;
                    color:#666;">
                    Schedule meetings, live streaming, polling,
                    messaging, recording and multi participant support.
                </div>
            `
        },{
            xtype:'container',
            margin:'40 0 0 0',
            layout:'hbox',
            defaults:{
                xtype:'button',
                scale:'large',
                margin:'0 15 0 0'
            },
            items:[
                {text:'📅 Schedule'},
                {text:'📊 Polling'},
                {text:'⏺ Record'},
                {text:'📡 Streaming'},
                {text:'💬 Messaging'},
                {text:'👥 Multi Participant'}
            ]
        },{
            xtype:'component',
            margin:'40 0 0 0',
            html:`
                <div style="
                    display:inline-block;
                    background:#123E9A;
                    color:white;
                    padding:10px 20px;
                    border-radius:30px;
                    font-size:22px;
                    font-weight:bold;">
                    🚀 COMING SOON
                </div>
            `
        }]
    },{
        xtype:'container',
        width:700,
        layout:'fit',
        padding:20,
        items:[{
            xtype:'panel',
            border:false,
            bodyStyle:{
                borderRadius:'20px',
                background:'#102030'
            },
            html:`
                <div style="
                    height:100%;
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    color:white;
                    font-size:32px;">
                    Video Conference Preview
                </div>
            `
        }]
    }]
})
JS;

?>