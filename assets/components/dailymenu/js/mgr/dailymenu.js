var DailyMenu = function(config) {
    config = config || {};
    DailyMenu.superclass.constructor.call(this,config);
};
Ext.extend(DailyMenu,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('dailymenu',DailyMenu);
DailyMenu = new DailyMenu();