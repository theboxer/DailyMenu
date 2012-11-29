Ext.onReady(function() {
    MODx.load({ xtype: 'dailymenu-page-home'});
});

DailyMenu.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'dailymenu-panel-home'
            ,renderTo: 'dailymenu-panel-home-div'
        }]
    });
    DailyMenu.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(DailyMenu.page.Home,MODx.Component);
Ext.reg('dailymenu-page-home',DailyMenu.page.Home);