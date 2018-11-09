function validate(form_id) {
    // console.log(form_id);
    var chk_fail = 0;
    var element_form = document.getElementById(form_id);
    // console.log(element_form.elements.length);
    for (var i = 0; i < element_form.elements.length; i++) {
        var attr = element_form[i].hasAttribute("validate");
        if (typeof attr !== typeof undefined && attr != false) { //เช็คว่า tag ไหนใส่ attr validate
            if(element_form[i].tagName != "BUTTON" && element_form[i].tagName != "button"){ // เช็คว่าไม่ใช่ปุ่ม
                var elem = element_form[i];
				var elem_id = element_form[i].id;//get id of element
				var prev_ele = $("#"+elem_id).parent().attr('id');//get id of previous elements	
				// console.log("prev_ele => "+prev_ele);
                var val = $("#"+elem_id).val(); //get val from input
                var wtf = elem.type;

                
                // console.log("attr ["+i+"] = "+attr);
                // console.log("elem ["+i+"] = "+elem);
                // console.log(wtf);
                // console.log("elem_id ["+i+"] = "+elem_id);
                // console.log("prev_ele ["+i+"] = "+prev_ele);
                // console.log("val ["+i+"] = "+val);

                if (elem.type == "text") {
                    if(val != "" && val != null){
                        // console.log(val);
                        // console.log(elem_id);
                        $("#"+elem_id).removeAttr('placeholder');
                        $("#"+elem_id).removeAttr("style");
                        
                    }else{
                        $("#"+elem_id).css("background","#fbe8e5");
                        $("#"+elem_id).css("border","2px solid red");
                        $("#"+elem_id).attr('placeholder','กรุณากรอกข้อมูล');
                        chk_fail++;
                    }//check null value
                }

                if (elem.type == "select-one") {
                    if(val == "" || val == null){
                        var elemIs = $("#"+elem_id).parent();
                        // console.log("elemIs1 = "+elemIs);
                        // console.log("selection is null");

                        chk_fail++;
                        
                        $("#select2-"+elem_id+"-container").parent().css({"background":"#fbe8e5","border":"2px solid red"});

					}else{
                        // console.log("selection is NOT null");
						$("#select2-"+elem_id+"-container").parent().removeAttr("style");
					}
                }
                // console.log(elem.type+"false");

                if (elem.type == "date") {
                    if(val != "" && val != null){
                        $("#"+elem_id).removeAttr("style");
                        // console.log("found date");
                    }else{
                        $("#"+elem_id).css("background","#fbe8e5");
                        $("#"+elem_id).css("border","2px solid red");
                        chk_fail++;
                        // console.log("NOT found date");
                    }//check null value
                }
                
            }
        }//if not button
        
    }
    console.log("chk_complete : "+chk_fail);
    if (chk_fail > 0) {
        return false;
    }else{
        return true;
    }
    // return to view
    
}