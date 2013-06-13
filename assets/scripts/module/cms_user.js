var CmsUsers = {
    initView: function(){
        var site_url = $('#site_url').html();
    },

    gridComplete: function() {
        var ids = $("#u_list").jqGrid('getDataIDs');
        for (var i = 0; i < ids.length; i++) {
            var cl = ids[i];
            checkout = "<input style='height:22px;width:75px;' type='button' value='Check Out' onclick=\" ??? \"  />";
            jQuery("#east-grid").jqGrid('setRowData', ids[i], { action: checkout });
        }
    },
};