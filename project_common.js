var selected_ex=[]
var selected_profile=[]
var selected_super_profile=[]
var copy_bin=''

function select_examination_js(me,ex_id,list_id)
{
	if(selected_ex.indexOf(ex_id) !== -1)
	{
		selected_ex.splice(selected_ex.indexOf(ex_id),1)
		document.getElementById(list_id).value=selected_ex
		me.classList.remove('bg-warning')
	}
	else
	{
		selected_ex.push(ex_id);
		document.getElementById(list_id).value=selected_ex
		me.classList.add('bg-warning')
	}
}

function select_profile_js(me,ex_id,list_id)
{
	if(selected_profile.indexOf(ex_id) !== -1)
	{
		selected_profile.splice(selected_profile.indexOf(ex_id),1)
		document.getElementById(list_id).value=selected_profile
		me.classList.remove('bg-warning')
	}
	else
	{
		selected_profile.push(ex_id);
		document.getElementById(list_id).value=selected_profile
		me.classList.add('bg-warning')
	}
}

function select_super_profile_js(me,ex_id,list_id)
{
	if(selected_super_profile.indexOf(ex_id) !== -1)
	{
		selected_super_profile.splice(selected_super_profile.indexOf(ex_id),1)
		document.getElementById(list_id).value=selected_super_profile
		me.classList.remove('bg-warning')
	}
	else
	{
		selected_super_profile.push(ex_id);
		document.getElementById(list_id).value=selected_super_profile
		me.classList.add('bg-warning')
	}
}

function toggle_color(me)
{
	if(me.classList.contains("btn-secondary"))
	{
		me.classList.remove('btn-secondary')
		me.classList.add('btn-primary')
	}
	else
	{
		me.classList.add('btn-secondary')
		me.classList.remove('btn-primary')
	}
}

function toggle_display(class_name)
{
	$("."+class_name).toggle()
}

function copy_to_bin(me)
{
	//copy_bin=copy_bin+me.innerHTML
	//alert(copy_bin)
	document.getElementById('cb_ta').value=document.getElementById('cb_ta').value+me.innerHTML
}

function clear_bin()
{
	//copy_bin='';
	//alert(copy_bin)
	document.getElementById('cb_ta').value=''
}

function copy_binn()
{
	x=document.getElementById('cb_ta')
	x.select()
	x.setSelectionRange(0, 99999)
	document.execCommand("copy")
}

function sync_result(me)
{
	//alert(me.getAttribute('data-type'));
	target=document.getElementById('r_id_'+me.getAttribute('data-sid')+'_'+me.getAttribute('data-exid'))
	target.value=me.value
	var event = new Event('change');
	target.dispatchEvent(event);
}

function sync_result_blob(me)
{
	//alert(me.getAttribute('data-uniq'));
	target=document.getElementById('r_id_'+me.getAttribute('data-sid')+'_'+me.getAttribute('data-exid'))
	target.value=me.value
	target.setAttribute('data-uniq',me.getAttribute('data-uniq'))
	var event = new Event('change');
	target.dispatchEvent(event);
}

function sync_with_that(me,that_element_id)
{
	//alert(me.getAttribute('data-type'));
	target=document.getElementById(that_element_id);
	target.value=me.value
	var event = new Event('change');
	target.dispatchEvent(event);
}

function sync_all()
{
	$("[id^=pr_id_]").each(
		function()
		{
			target=document.getElementById('r_id_'+$(this).attr('data-sid')+'_'+$(this).attr('data-exid'))
			target.setAttribute('data-uniq',$(this).attr('data-uniq'))
			target.value=$(this).val()
			var event = new Event('change');
			target.dispatchEvent(event);		
		}
	)
}

function calcuate_for_target(me,target_element_id,equation)
{
	alert(target_element_id+equation)
}

function set_print_class(jsn)
{
	//alert(jsn)
	ar=JSON.parse(jsn)
	$("[id^=ex_]").css('display','none')
	ar.forEach(
				function(x)
				{
					$("#ex_"+x).css('display','')
				}
	
				)
}


function my_sort(me,col_index,my_table)
{
	cur_val=me.getAttribute("data-sorting")
	//alert(col_index + ' ' + cur_val);
	me.setAttribute("data-sorting",cur_val*-1);
	//alert(col_index);
	
	done_something=true
	while(done_something==true)
	{
        done_something=false
        tbl=document.getElementById(my_table)
        all_rows = tbl.rows
        for (i = 1; i < (all_rows.length - 1); i++)	//omit header row
        {
            //alert(all_rows[i].getElementsByTagName("TD")[col_index].innerHTML)
            //first = all_rows[i].getElementsByTagName("TD")[col_index].innerHTML.toLowerCase();
            //second = all_rows[i+1].getElementsByTagName("TD")[col_index].innerHTML.toLowerCase();
            first = all_rows[i].getElementsByTagName("TD")[col_index].innerHTML
            second = all_rows[i+1].getElementsByTagName("TD")[col_index].innerHTML

            if(cur_val==1)	//ascending
            {
                if ( first > second ) //(Z,A) Z>A
                {
					//node.insertBefore(newnode, existingnode)
					//ascending: result should be (A,Z)
                    all_rows[i].parentNode.insertBefore(all_rows[i+1], all_rows[i]);
                    done_something=true
                }
                //else do nothing
            }
            else  			//descending
            {
                 if ( first < second ) //((A,Z) A<Z
                {
					//node.insertBefore(newnode, existingnode)
					//ascending: result should be (Z,A)
                    all_rows[i].parentNode.insertBefore(all_rows[i + 1], all_rows[i]);
                    done_something=true
                }           
            
            }
        }
    }
}


function my_sort_float(me,col_index,my_table)
{
	cur_val=me.getAttribute("data-sorting")
	//alert(col_index + ' ' + cur_val);
	me.setAttribute("data-sorting",cur_val*-1);
	//alert(col_index);
	
	done_something=true
	while(done_something==true)
	{
        done_something=false
        tbl=document.getElementById(my_table)
        all_rows = tbl.rows
        for (i = 1; i < (all_rows.length - 1); i++)	//omit header row
        {
            //alert(all_rows[i].getElementsByTagName("TD")[col_index].innerHTML)
            //first = all_rows[i].getElementsByTagName("TD")[col_index].innerHTML.toLowerCase();
            //second = all_rows[i+1].getElementsByTagName("TD")[col_index].innerHTML.toLowerCase();
            first = parseFloat(all_rows[i].getElementsByTagName("TD")[col_index].innerHTML)
            second = parseFloat(all_rows[i+1].getElementsByTagName("TD")[col_index].innerHTML)
			if(Number.isNaN(first))
			{
				//alert('NA')
				all_rows[i].parentNode.appendChild(all_rows[i]);
			}
			if(Number.isNaN(second))
			{
				all_rows[i].parentNode.appendChild(all_rows[i+1]);
			}
			else
			{
				if(cur_val==1)
				{
					if ( first > second ) 
					{
						all_rows[i].parentNode.insertBefore(all_rows[i + 1], all_rows[i]);
						done_something=true
					}
				}
				else
				{
					 if ( first < second ) 
					{
						all_rows[i].parentNode.insertBefore(all_rows[i + 1], all_rows[i]);
						done_something=true
					}           
				
				}
			}
        }
    }
}

function show_comment_modal()
{
		
}

$(document).ready
	(
		function()
		{
			//$("input[type!=file]").change(
			$(".autosave").change(
								function()
								{
									//alert($(this).attr('minlength')+$(this).val().length)
									
									//if( $(this).attr('minlength') > $(this).val().length)
									//{
									//	alert("do")
									//	focus($(this))
									//	return false;
									//}
									
									$.post(
											"save_record.php",
											{
												examination_id: $(this).attr('data-exid'),
												sample_id: $(this).attr('data-sid'),
												result: $(this).val(),
												user: $(this).attr('data-user')
											 },
											function(data,status)
											{
												//alert("Data: " + data + "\nStatus: " + status);
												$("#response").html(data)
											}
										);
								}
							);
							

			$(".autosave-blob").change(
								function()
								{
									
									$.post(
											"save_record_blob.php",
											{
												examination_id: $(this).attr('data-exid'),
												sample_id: $(this).attr('data-sid'),
												result: $(this).val(),
												type: $(this).attr('data-type'),
												uniq: $(this).attr('data-uniq'),
												user: $(this).attr('data-user')
											 },
											function(data,status)
											{
												//alert("Data: " + data + "\nStatus: " + status);
												$("#response").html(data)
											}
										);
								}
							);
							
														
					$(".autosave-yesno").click(
								function()
								{
									if($(this).val()!='yes')
									{
										$(this).val('yes')
										$(this).html('yes')
									}
									else
									{
										$(this).val('no')
										$(this).html('no')
									}
									
									$.post(
											"save_record.php",
											{
												examination_id: $(this).attr('data-exid'),
												sample_id: $(this).attr('data-sid'),
												result: $(this).val(),
												user: $(this).attr('data-user')
											 },
											function(data,status)
											{
												//alert("Data: " + data + "\nStatus: " + status);
												$("#response").html(data)
											}
										);
								}
							);

					$(".autosave-select").change(
								function()
								{									
									$.post(
											"save_record.php",
											{
												examination_id: $(this).attr('data-exid'),
												sample_id: $(this).attr('data-sid'),
												result: $(this).val(),
												user: $(this).attr('data-user')
											 },
											function(data,status)
											{
												//alert("Data: " + data + "\nStatus: " + status);
												$("#response").html(data)
											}
										);
								}
							);			
		}
	);


