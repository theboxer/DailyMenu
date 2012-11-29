
DailyMenu.grid.Dishes = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'dailymenu-grid-dishes'
        ,url: DailyMenu.config.connector_url
        ,baseParams: {
            action: 'mgr/dish/getlist'
        }
        ,save_action: 'mgr/dish/updatefromgrid'
        ,autosave: true
        ,ddGroup: 'dailymenuDishDDGroup'
        ,enableDragDrop: true
        ,stripeRows: true
        ,fields: ['id','name','price', 'bold']
        ,autoHeight: true
        ,paging: true
        ,remoteSort: true
        ,listeners: {
            'render': function(g) {
                var ddrow = new Ext.ux.dd.GridReorderDropTarget(g, {
                    copy: false
                    ,listeners: {
                        'beforerowmove': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowmove': function(objThis, oldIndex, newIndex, records) {

                            MODx.Ajax.request({
                                url: DailyMenu.config.connectorUrl
                                ,params: {
                                    action: 'mgr/dish/reorder'
                                    ,idDish: records.pop().id
                                    ,oldIndex: oldIndex
                                    ,newIndex: newIndex
                                    ,date: Ext.getCmp('dailymenu-dishes-datepicker').value
                                }
                                ,listeners: {

                                }
                            });
                        }

                        ,'beforerowcopy': function(objThis, oldIndex, newIndex, records) {
                        }

                        ,'afterrowcopy': function(objThis, oldIndex, newIndex, records) {
                        }
                    }
                });

                    Ext.dd.ScrollManager.register(g.getView().getEditorParent());
            }
            ,beforedestroy: function(g) {
                    Ext.dd.ScrollManager.unregister(g.getView().getEditorParent());
            }
        }
        ,columns: [{
            header: _('id')
            ,dataIndex: 'id'
            ,width: 70
        },{
            header: _('name')
            ,dataIndex: 'name'
            ,width: 200
            ,editor: { xtype: 'textfield' }
        },{
            header: _('dailymenu.price')
            ,dataIndex: 'price'
            ,width: 250
            ,editor: { xtype: 'textfield' }
        },{
            header: _('dailymenu.bold')
            ,dataIndex: 'bold'
            ,width: 50
            ,editor: { xtype: 'modx-combo-boolean', renderer: true}
        }]
        ,tbar: [{
            text: _('date')
            ,xtype: 'datefield'
            ,id: 'dailymenu-dishes-datepicker'
            ,format: MODx.config.manager_date_format
            ,emptyText: _('today')
            ,startDay: 1
            ,listeners: {
                'select': {fn:this.filterDay,scope:this}
            }
        },{
            text: _('dailymenu.dish_create')
            ,handler: this.createItem
            ,scope: this
        },'->',{
            xtype: 'textfield'
            ,id: 'dailymenu-search-filter'
            ,emptyText: _('dailymenu.search...')
            ,listeners: {
                'change': {fn:this.search,scope:this}
                ,'render': {fn: function(cmp) {
                    new Ext.KeyMap(cmp.getEl(), {
                        key: Ext.EventObject.ENTER
                        ,fn: function() {
                            this.fireEvent('change',this);
                            this.blur();
                            return true;
                        }
                        ,scope: cmp
                    });
                },scope:this}
            }
        }]
    });
    DailyMenu.grid.Dishes.superclass.constructor.call(this,config);
};
Ext.extend(DailyMenu.grid.Dishes,MODx.grid.Grid,{
    windows: {}

    ,getMenu: function() {
        var m = [];
        m.push({
            text: _('dailymenu.dish_update')
            ,handler: this.updateItem
        });
        m.push('-');
        m.push({
            text: _('dailymenu.dish_remove')
            ,handler: this.removeItem
        });
        this.addContextMenuItem(m);
    }

    ,filterDay: function(cb,nv,ov) {
        this.getStore().setBaseParam('filterDay',cb.getValue());
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
    
    ,createItem: function(btn,e) {
        if (!this.windows.createItem) {
            this.windows.createItem = MODx.load({
                xtype: 'dailymenu-window-dish-create'
                ,listeners: {
                    'success': {fn:function() { this.refresh(); },scope:this}
                }
            });
        }
        this.windows.createItem.fp.getForm().reset();
        this.windows.createItem.setValues({date: Ext.getCmp('dailymenu-dishes-datepicker').value});
        this.windows.createItem.show(e.target);
    }
    ,updateItem: function(btn,e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        var r = this.menu.record;

        if (!this.windows.updateItem) {
            this.windows.updateItem = MODx.load({
                xtype: 'dailymenu-window-dish-update'
                ,record: r
                ,listeners: {
                    'success': {fn:function() { this.refresh(); },scope:this}
                }
            });
        }
        this.windows.updateItem.fp.getForm().reset();
        this.windows.updateItem.fp.getForm().setValues(r);
        this.windows.updateItem.show(e.target);
    }
    
    ,removeItem: function(btn,e) {
        if (!this.menu.record) return false;
        
        MODx.msg.confirm({
            title: _('dailymenu.dish_remove')
            ,text: _('dailymenu.dish_remove_confirm')
            ,url: this.config.url
            ,params: {
                action: 'mgr/dish/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': {fn:function(r) { this.refresh(); },scope:this}
            }
        });
    }

    ,search: function(tf,nv,ov) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }
});
Ext.reg('dailymenu-grid-dishes',DailyMenu.grid.Dishes);




DailyMenu.window.CreateDish = function(config) {
    config = config || {};
    this.ident = config.ident || 'dailymenu-cdish';
    Ext.applyIf(config,{
        title: _('dailymenu.dish_create')
        ,id: this.ident
        ,height: 150
        ,width: 475
        ,url: DailyMenu.config.connector_url
        ,action: 'mgr/dish/create'
        ,fields: [{
            xtype: 'textfield'
            ,fieldLabel: _('name')
            ,name: 'name'
            ,id: this.ident+'-name'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('dailymenu.price')
            ,name: 'price'
            ,id: this.ident+'-price'
            ,anchor: '100%'
        },{
            xtype: 'xcheckbox'
            ,fieldLabel: _('dailymenu.bold')
            ,name: 'bold'
            ,id: this.ident+'-bold'
            ,anchor: '100%'
        },{
            xtype: 'datefield'
            ,format: MODx.config.manager_date_format
            ,fieldLabel: _('date')
            ,emptyText: _('today')
            ,name: 'date'
            ,id: this.ident+'-date'
            ,anchor: '100%'
        }]
    });
    DailyMenu.window.CreateDish.superclass.constructor.call(this,config);
};
Ext.extend(DailyMenu.window.CreateDish,MODx.Window);
Ext.reg('dailymenu-window-dish-create',DailyMenu.window.CreateDish);


DailyMenu.window.UpdateDish = function(config) {
    config = config || {};
    this.ident = config.ident || 'dailymenu-udish';
    Ext.applyIf(config,{
        title: _('dailymenu.dish_update')
        ,id: this.ident
        ,height: 150
        ,width: 475
        ,url: DailyMenu.config.connector_url
        ,action: 'mgr/dish/update'
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
            ,id: this.ident+'-id'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('name')
            ,name: 'name'
            ,id: this.ident+'-name'
            ,anchor: '100%'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('dailymenu.price')
            ,name: 'price'
            ,id: this.ident+'-price'
            ,anchor: '100%'
        },{
            xtype: 'xcheckbox'
            ,fieldLabel: _('dailymenu.bold')
            ,name: 'bold'
            ,id: this.ident+'-bold'
            ,anchor: '100%'
        },{
            xtype: 'datefield'
            ,format: MODx.config.manager_date_format
            ,fieldLabel: _('date')
            ,emptyText: _('today')
            ,name: 'date'
            ,id: this.ident+'-date'
            ,anchor: '100%'
        }]
    });
    DailyMenu.window.UpdateDish.superclass.constructor.call(this,config);
};
Ext.extend(DailyMenu.window.UpdateDish,MODx.Window);
Ext.reg('dailymenu-window-dish-update',DailyMenu.window.UpdateDish);