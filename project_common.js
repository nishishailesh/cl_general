var selected_ex=[]
var selected_profile=[]

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

function sync_result(me)
{
	//alert(me.getAttribute('data-exid'));
	target=document.getElementById('r_id_'+me.getAttribute('data-sid')+'_'+me.getAttribute('data-exid'))
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
		target.value=$(this).val()
		var event = new Event('change');
		target.dispatchEvent(event);		
	}
	
	
	
	)
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
$(document).ready
	(
		function()
		{
			//$("input[type!=file]").change(
			$(".autosave").change(
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
