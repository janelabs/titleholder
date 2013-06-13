var CmsUsers = {
    initView: function(){
        var site_url = $('#site_url').html();

        $("#delete").click(function(){
            var gr = $("#u_list").jqGrid('getGridParam','selrow');

            var ans = confirm("Are you sure you want to delete selected user?");
            if (ans) {
                window.location = site_url + 'cms/users/delete/' + gr;
            }
        });
    }
};