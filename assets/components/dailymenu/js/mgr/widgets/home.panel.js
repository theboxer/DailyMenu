DailyMenu.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,cls: 'container'
        ,items: [{
            html: '<h2>'+_('dailymenu')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,activeItem: 0
            ,hideMode: 'offsets'
            ,items: [{
                title: _('dailymenu.dishes')
                ,items: [{
                    html: '<p>'+_('dailymenu.intro_msg')+'</p>'
                    ,border: false
                    ,bodyCssClass: 'panel-desc'
                },{
                    xtype: 'dailymenu-grid-dishes'
                    ,preventRender: true
                    ,cls: 'main-wrapper'
                }]
            }]
        }]
    });
    DailyMenu.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(DailyMenu.panel.Home,MODx.Panel);
Ext.reg('dailymenu-panel-home',DailyMenu.panel.Home);