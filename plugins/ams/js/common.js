function xhr (page,arguments,info){
            var xhr_object = null;
            
            if(window.XMLHttpRequest) // Firefox
              xhr_object = new XMLHttpRequest();
            else if(window.ActiveXObject) // Internet Explorer
              xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
            else { // XMLHttpRequest non supportï¿½par le navigateur
              alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
              return;
            }

            xhr_object.open("POST", page, true);
            
            xhr_object.onreadystatechange = function() {
              //if(xhr_object.readyState == 4) 
				//alert(xhr_object.responseText);
                //eval(xhr_object.responseText);
              		
            }

            xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=iso-8859-1");
            var data = arguments ;
			//alert(xhr_object);
            try{
			//alert(page+" , "+data);
                        success(info);
			xhr_object.send(data);
			}
			catch(err){
			alert("erreur : "+err.name);
			}
}

function ConfigUser(id,value){ 
	//alert(value)
	xhr("/ams/ajax/configuser","id="+id+"&value="+value+"","Mise à jours effectué");
}

function ConfigRole(id,value){ 
	//alert(value)
	xhr("/ams/ajax/configrole","id="+id+"&value="+value+"","Mise à jours effectué");
}

function success(info) {
    $.noty.consumeAlert({layout: 'topCenter', type: 'success', dismissQueue: true, timeout: 1500 , closeWith: ['hover']});
    alert(info);
}
$(document).ready(function(){
    var rowNum = 0;
    function addRow(frm) {
        rowNum ++;
        var row ='<td><input type="text" class="form-control" value="" /></td>   ';
       // var row = '<p id="rowNum'+rowNum+'">Item quantity: <input type="text" name="qty[]" size="4" value="'+frm.add_qty.value+'"> Item name: <input type="text" name="name[]" value="'+frm.add_name.value+'"> <input type="button" value="Remove" onclick="removeRow('+rowNum+');"></p>';
        jQuery('#itemRows').append(row);
        frm.add_qty.value = '';
        frm.add_name.value = '';
    }
});