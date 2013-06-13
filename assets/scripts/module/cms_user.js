var CmsUsers = {
    initView: function(){
        var site_url = $('#site_url').html();

        $("#delete").click(function(){
            var gr = $("#u_list").jqGrid('getGridParam','selrow');
            if( gr != null ) {
                var ans = confirm("Are you sure you want to delete selected user?");
                if (ans) {
                    window.location = site_url + 'cms/users/delete/' + gr;
                }
            } else {
                alert("You must select a row");
            }
        });

        $("#edit").click(function(){
            var gr = $("#u_list").jqGrid('getGridParam','selrow');
            if( gr != null ) {
                var data = $("#u_list").jqGrid('getRowData',gr);
                $('#uname').val(data.name);
                $('#email').val(data.email);
                $('#uid').val(data.id);
                $('#edit_user').modal();
            } else {
                alert("You must select a row");
            }
        });

        $('#saveEdit').on("click", function(){
            $.post(site_url + 'cms/users/edit', $('#edituser').serialize(), function(){
                window.location = site_url + 'cms/users';
            });
        });
    }
};