$(document).ready(function(){
	$(".delete_client").click(function(){
		if(!confirm("Вы действительно хотите удалить подразделение?"))
			return;
		var del = $(this);
		var id =  $(del).attr('idd');
		$.ajax({
			type: "POST",
			url: "include/delete_client.php",
			data: "idd=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data == 1){
					$(del).parent().parent().remove();
				}
				else{
					alert(data);
				}
			}
		});
	});

	$(".clients").click(function(){
		var id = $(this).attr("idd");
		window.location = "/managers/show_client.php?id=" + id;
	});

	$(".select_subdivision").change(function(){
		var id = $(this).val();
		if(id == -1){
			$(".insert_subdivision").html("");
			$(".link_add_subdivision").attr("href", "");
			$(".link_add_subdivision").html("");
			return;
		}
		$(".link_add_subdivision").attr("href", "add_subdivision.php?id=" + id);
		$(".link_add_subdivision").html("Добавить");
		$.ajax({
			type: "POST",
			url: "include/select_subdivision.php",
			data: "id=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				$(".insert_subdivision").html(data);
			}
		});
	});

	$(".select_employees").change(function(){
		var id = $(this).val();
		if(id == -1){
			$(".insert_employees").html("");
			$(".link_add_employee").attr("href", "");
			$(".link_add_employee").html("");
			return;
		}
		$(".link_add_employee").attr("href", "add_employee.php?id=" + id);
		$(".link_add_employee").html("Добавить");
		$.ajax({
			type: "POST",
			url: "include/select_employees.php",
			data: "id=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				$(".insert_employees").html(data);
			}
		});
	});

	$(".insert_subdivision").on("click", ".del_subdivision", function(){
		if(!confirm("Вы действительно хотите удалить подразделение?"))
			return;
		var del = $(this);
		var id = del.attr("idd");
		$.ajax({
			type: "POST",
			url: "include/delete_subdivision.php",
			data: "id=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data == 1){
					$(del).parent().parent().remove();
				}
				else{
					alert(data);
				}
			}
		});
	});

	$(".insert_employees").on("click", ".del_employees", function(){
		if(!confirm("Вы действительно хотите удалить сотрудника?"))
			return;
		var del = $(this);
		var id = del.attr("idd");
		$.ajax({
			type: "POST",
			url: "include/delete_employees.php",
			data: "id=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data == 1){
					$(del).parent().parent().remove();
				}
				else{
					alert(data);
				}
			}
		});
	});

	$(".del_users").click(function(){
		if(!confirm("Вы действительно хотите удалить пользователя?"))
			return;
		var del = $(this);
		var id = del.attr("idd");
		$.ajax({
			type: "POST",
			url: "include/delete_users.php",
			data: "id=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data == 1){
					$(del).parent().parent().remove();
				}
				else{
					alert(data);
				}
			}
		});
	});


});
