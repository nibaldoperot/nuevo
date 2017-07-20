<style>
#my-div
{
    width    : 100%;
    height   : 900px;
    overflow : hidden;
    position : relative;
}

#wplc_admin_chat_holder
{
    position : absolute;
    top      : -100px;
    left     : 0px;
    width    : 100%; 
    height   : 100%;
}
</style>
<button type="button" style="width:48%;" class="btn btn-default ver_home btn-lg"> Home</button>
<button type="button" style="width:48%;" class="btn btn-default logout btn-lg"> Logout</button>
<div id="my-div">
<iframe src="http://192.168.0.32/_Finanzas/htdocs/app/wp-admin/admin.php?page=wplivechat-menu" id="wplc_admin_chat_holder" scrolling="yes"></iframe>
</div>

