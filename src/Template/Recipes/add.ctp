<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recipe $recipe
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Recipes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="recipes form large-9 medium-8 columns content">
    <?= $this->Form->create($recipe) ?>
    <fieldset>
        <legend><?= __('Add Recipe') ?></legend>
        <?php
            echo $this->Form->control('recipes_name');
            echo $this->Form->control('category',array('type'=>'select','options'=>$category)); 
            echo $this->Form->control('preparation_method');
        ?>
        
        
       
    </fieldset>
    
    <table id="recipeTable">
    <tr>
     <td><?php echo $this->Form->control('checkbox',array('type'=>'checkbox','name'=>'chk[]','id'=>'chk[]'));?></td>
    <td><?php echo $this->Form->control('item_id',array('type'=>'select','options'=>$items, 'name'=>'items[]','onchange'=>'change(this)')); ?></td>
    <td><?php echo $this->Form->control('quantity', array('name'=>'qty[]','required'=>'true')); ?></td>
    <td><?php echo $this->Form->control('unit_id',array('type'=>'select','options'=>$units, 'name'=>'units[]')); ?></td>
    </tr>
     <input type="button" onclick="add_row()" value="Add row" > 
     <input type="button" id="delrtbutton" value="Delete row" onclick="check()"> 
    
    
    </table>
    
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    </div>

<script src="/js/jquery-3.3.1.min.js"></script>
<script>
    var item_select_box=document.getElementById('item-id');
    window.onload=change(item_select_box);
    function add_row() {
 	var units = <?php echo json_encode($units)?>;
	var unit_options = "";
	for(var k in units)
	{
	unit_options+= "<option value=' "+ k +" '>" +units[k]+ "</option>";
	}
	var items = <?php echo json_encode($items) ?>;
	var item_options = "";
	for(var k in items)
	{
	item_options+= "<option value=' "+ k +" '>" +items[k]+ "</option>";
	}
	
    var table = document.getElementById("recipeTable");
    var no_of_rows=$('#recipeTable tr').length;
    var rowCount=$('#recipeTable tr').length; 
    var row = table.insertRow().innerHTML = '<tr>\
    <td><input type="checkbox" name="chk[]" id=chk'+(rowCount+1)+'></td>\
    <td><select name="items[]" onchange="change(this)" id=item-id'+(no_of_rows)+'>'+item_options+'</select></td>\
    <td><?php echo $this->Form->control(' ', array('name'=>'qty[]')); ?></td>\
    <td><select name="units[]" id=unit-id'+(no_of_rows)+'>'+unit_options+'</select></td>\
    </tr>';
   // var item_select_box = document.getElementById('item-id'+no_of_rows);
    //change(item_select_box);
    var item_select_box = document.getElementById('item-id'+no_of_rows);
    change(item_select_box);
    }
    
  function change(element) 
	{
	//console.log("bbb");
	var item_select_box=document.getElementById(element.id);
	
	//this will give the selected dropdown value,tht is item id
	
	var selected_value=item_select_box.options[item_select_box.selectedIndex].value;
	
	console.log("1111111111111",selected_value);
	
	console.log(element.id);
	
	var element_id=element.id.replace(/[^0-9]/g, '');
	console.log("ghgh",element_id);
	
	
	if(element_id ==""){
	console.log("jjjj");
			var unit=$('#unit-id');
	 		unit.empty();
			}
			if(element_id>=1){
			var unit_select_box=$('#unit-id'+element_id);
			unit_select_box.empty();
		  }
	
	
	
	//console.log(selected_value);
	//current_row=element.id[element.id.length -1];
	
	//console.log(current_row);
	
//	if(current_row =="d"){
	//		var unit=$('#unit-id');
	 //		unit.empty();
		//	}
			//else{
			//var unit_select_box=$('#unit-id'+current_row);
			//unit_select_box.empty();
		  //}
		$.ajax({
			type: 'get',
			url: '/recipes/getunits',
		    data: { 
		    itemid: selected_value
		    },
			beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
			success: function(response) {
			if (response.error) {
				alert(response.error);
				console.log(response.error);
			}
			if(response){
			//if(current_row=="d"){
			if(element_id==""){
			for(var k in response){
			$("#unit-id").append("<option value=' "+ k +" '>" +response[k]+ "</option>");
			      }
			      console.log("1111111d","#unit-id");
			     }
			if(element_id>=1){
			  //}
			//else{
			for(var k in response)
				{
			   	$("#unit-id"+element_id).append("<option value=' "+ k +" '>" +response[k]+ "</option>");
			  	}
				}
			}
		}
		
	});	
   //console.log(item-id);
	}
	
	function check()
	{
		var ingredient_dlt=$('#ingredient-id');
		var check_box=document.getElementsByName("chk[]");
		var checkbox_id = new Array();
		$("input[name='chk[]']:checked").each(function(){
			console.log($(this).attr('id'));		
			if($(this).is(":checked")){
				var chkid = $('#'+$(this).attr('id'));
				var isnum = /^\d+$/.test($(this).attr('id'));				
				if(!isnum)
				{				
					chkid.closest('tr').remove();
				}
				else{
				   checkbox_id.push($(this).attr('id'));
				}
			}
	});
	if(checkbox_id.length > 0){
	console.log(checkbox_id);
	$.ajax({ 
			type: 'POST',
			async:true,
			cache:false,
			url: '/recipes/getitems',
		  	data: { 
		    ingredientid:checkbox_id
		  	},
		  	dataType: 'json',
			beforeSend: function(xhr) {
			//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xhr.setRequestHeader('X-CSRF-Token',$('[name="_csrfToken"]').val());
			},
			success: function(response) {
				if (response.error) {
					alert(response.error);
					console.log(response.error);
					}
				if(response){
					checkbox_id.forEach(function(entry){
					console.log(entry);
					var chkid = $('#'+entry);
			    	chkid.closest('tr').remove();
				});
				}
				}
	});
	//console.log(chkid);
	}
	}
	</script>