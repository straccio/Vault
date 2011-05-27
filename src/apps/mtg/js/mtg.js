Ext.onReady(
    function(){
	Ext.BLANK_IMAGE_URL = 'js/ext4/resources/images/default/s.gif';
	Ext.Direct.addProvider(Vault.MTG._APIDesc);
	Vault.MTG.searchCards([{"index":0,"level":-20000,"field":"Nameen","value":"1","operator":"eq","junction":"or"}],0,0,'','','');
    }
);