<div class="form-group" style="">
	<div class="form-group">
        <span id="sitename"></span>
		<label id="lable">UPADTE SITE NAME</label>
    <input tyep="text" name="editsite-name"  id="editsite-name" class="form-control" value="{{website_name}}">
	</div>
   
    <button type ="submit" class="btn btn-info" id="namechange" onclick ="update_Sitename()">
    	CHANGE 
    </button>
</div>

<form id="form" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label id="lable">UPADTE URL LOGO</label>
        <input type="file" name="image"  id="update-url" class="form-control">
	</div>
   
    <button type ="submit" class="btn btn-info" id="logochange" >
    	CHANGE 
    </button>
</form>