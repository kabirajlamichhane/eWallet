<div>
	<table class="table"> 
		{{#each categorydata}}
			<tr>
				<td>{{@key}}</td>
				<td>{{this}}</td>
				<td><button type="submit" class="btn btn-danger" id="{{@key}}" onclick="delete_data(this)">DELETE
				</button></td>

				<td><button type="submit" class="btn btn-success" onclick="show_edit_data('{{@key}}','{{this}}')">EDIT
				</button></td>

			</tr>
		{{/each}}
	</table>

	<div>
		<button type="submit" class="btn btn-info" onclick="show_add_data_value()">ADD DATA AND VALUE</button>
	</div> 

	<form  onsubmit="add_category_datavalue()" style="display:none" id="datavalue_field">

		<div class="form-group" >
	    	<label id="lable">NEW CATEGORY DATA</label>
			    <input type="text" id="category_data" class="form-control">
		</div>

		<div class="form-group" >
	    	<label id="lable">NEW CATEGORY VALUE</label>
			    <input type="text" id="category_value" class="form-control">
		</div>

	    <button type ="submit" class="btn btn-info" style="
			    margin-left: 832px;
			    margin-top: 10px;">SUBMIT
		</button>

	</form>

	<div class="form-group" style="display: none" id="data_edit" onclick="">

		<div class="form-group">
			<label id="lable">EDIT CATEGORY_data</label>
	    <input tyep="text" name="editdata"  id="editdata" class="form-control">
		</div>
	   
	   <div class="form-group">
	   		<label id="lable">EDIT CATEGORY_VALUE</label> 
	   		<input type="text" name="editvalue" id="editvalue" class="form-control">
	   </div>
	    
	    <button type ="submit" class="btn btn-info" id="category-edit" onclick="return edit_data(this)" style="
		    margin-left: 832px;
		    margin-top: 10px;">SUBMIT
	    </button>

	</div>
 
</div>
