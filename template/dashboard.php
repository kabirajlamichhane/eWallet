<div>
    <table class="table">
        {{#each data}}
            <tr>
                <td onclick="category_data('{{this}}')">{{ this }}</td>
                <td><button type="submit" class="btn btn-danger" onclick ="delete_category('{{this}}')" >DELETE</button></td>

                <td><button type="submit" class="btn btn-success" onclick="show_category_edit_form('{{this}}')">EDIT</button></td>

            </tr>
       {{/each}}
   	
    </table>

    <button type= "submit" class="btn btn-primary" id="category" onclick="show_category_form()">          ADDCATEGORY
    </button>

    <form  onsubmit="return add_category();" style="display: none" id="category_field">

        <div class="form-group">
            <label id="lable">NEW CATEGORY</label>
            <input type="category" id="category-name" class="form-control">
            <button type ="submit" class="btn btn-info" style="
                margin-left: 832px;
                margin-top: 10px;">SUBMIT
            </button>
        </div>

    </form>

    <div class="form-group" style="display: none" id="edit-div">
        <label id="lable">EDIT CATEGORY</label>
        <input tyep="text" id="edit-category" class="form-control">
        <button type ="submit" class="btn btn-info" id="submit-edit" name="" onclick="return edit_category(this)" style="
        margin-left: 832px;
        margin-top: 10px;">SUBMIT
        </button>
    </div>
<div>