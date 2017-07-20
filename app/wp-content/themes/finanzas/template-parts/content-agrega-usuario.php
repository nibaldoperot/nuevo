<style>
#my-div
{
    width: 100%;
    height: 1100px;
    overflow: hidden;
    position: relative;

}

#wpbody-content
{
   position: absolute;
    top: -150px;
    left: 0px;
    width: 100%;
    height: 100%;


}
</style>
<button type="button" style="width:48%;" class="btn btn-default ver_home btn-lg"> Home</button>
<button type="button" style="width:48%;" class="btn btn-default logout btn-lg"> Logout</button>
<div id="my-div">
<iframe src="http://192.168.0.32/_Finanzas/htdocs/app/wp-admin/user-new.php" id="wpbody-content" scrolling="no"></iframe>
</div>

