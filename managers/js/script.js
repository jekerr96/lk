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
			$(".link_add_subdivision").toggleClass("btn_add");
			return;
		}
		$(".link_add_subdivision").attr("href", "add_subdivision.php?id=" + id);
		$(".link_add_subdivision").html("Добавить");
		$(".link_add_subdivision").toggleClass("btn_add");
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

	$(".select_trips").change(function(){
		var id = $(this).val();
		if(id == -1){
			$(".insert_trips").html("");
			$(".link_add_trips").attr("href", "");
			$(".link_add_trips").html("");
			$(".link_add_trips").toggleClass("btn_add");
			return;
		}
		$(".link_add_trips").attr("href", "add_trips.php?id=" + id);
		$(".link_add_trips").html("Добавить");
		$(".link_add_trips").toggleClass("btn_add");
		$.ajax({
			type: "POST",
			url: "include/select_trips.php",
			data: "id=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				$(".insert_trips").html(data);
			}
		});
	});

	$(".select_employees").change(function(){
		var id = $(this).val();
		if(id == -1){
			$(".insert_employees").html("");
			$(".link_add_employee").attr("href", "");
			$(".link_add_employee").html("");
			$(".link_add_employee").toggleClass("btn_add");
			return;
		}
		$(".link_add_employee").attr("href", "add_employee.php?id=" + id);
		$(".link_add_employee").html("Добавить");
		$(".link_add_employee").toggleClass("btn_add");
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

	$(".insert_trips").on("click", ".table_trips_line", function(){
		var id = $(this).attr("ids");
		document.location.href = "show_trip.php?id=" + id;
	});

	$(".btn_add_new_service").click(function(){
		var type = $(".type_add_service").val();
		var id = $(this).attr("idt");
		switch (type) {
			case "1":
				document.location.href = "add_avia.php?id=" + id;
				break;
			case "2":
				document.location.href = "add_avto.php?id=" + id;
				break;
			case "3":
				document.location.href = "add_jd.php?id=" + id;
				break;
			case "4":
				document.location.href = "add_hotel.php?id=" + id;
				break;
			default:

		}
	});

	$(".del_avia, .del_avto, .del_jd, .del_hotel").click(function(){
		if(!confirm("Вы действительно хотите удалить услугу?"))
			return;
			var id = $(this).attr("idd");
			var del_table = $("#" + id);
			$.ajax({
				type: "POST",
				url: "include/delete_services.php",
				data: "id=" + id,
				dataType: "html",
				cache: false,
				success: function(data) {
					if(data == 1){
						$(del_table).remove();
					}
					else{
						alert(data);
					}
				}
			});
	});

	$(".del_trips").click(function(){
		if(!confirm("Вы действительно хотите удалить деловую поездку?"))
			return;
		var id = $(this).attr("idd");
		$.ajax({
				type: "POST",
				url: "include/delete_trips.php",
				data: "id=" + id,
				dataType: "html",
				cache: false,
				success: function(data) {
					if(data == 1){
						document.location.href = "trips.php";
					}
					else{
						alert(data);
					}
				}
			});
	});
});
