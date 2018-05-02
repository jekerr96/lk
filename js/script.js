$(document).ready(function(){
	check_current();
	function check_current(){
		var href = document.location.href.split('/');
		var url = "include/";
		//console.log(href[3]);
		$(".current").removeClass("current");
		switch(href[3]){
			case "" :
				url += "index.php";
				$(".index").addClass("current");
				break;
			case "subdivision" :
				url += "subdivision.php";
				$(".subdivision").addClass("current");
				break;
			case "employees":
				url += "employees.php";
				$('.employees').addClass("current");
				break;
			case "trips":
				url += "trips.php";
				$('.trips').addClass("current");
				break;
			case "contacts":
				url += "contacts.php";
				$('.contacts').addClass("current");
				break;
			case "add_employee":
				url += "add_employee.php";
				$('.employees').addClass("current");
				break;
			case "add_subdivision":
				url += "add_subdivision.php";
				$('.subdivision').addClass("current");
				break;
			case "add_trips":
				url += "add_trips.php";
				$('.trips').addClass("current");
				break;

		}
		//console.log(url);
		$.ajax({
			type: "POST",
			url: url,
			data: "",
			dataType: "html",
			cache: false,
			success: function(data) {
				$(".content").html("");
				$(".content").append(data);
			}
		});
	}

	$(".nav > ul > li > a").click(function(){
		if($(this).attr("attr") == "exit")
			document.location.href = "/exit.php";
		var href = $(this).attr("href");
		window.history.pushState(new Date(), "Подразделения", href);
		check_current();
		return false;
	});


	$(".content").on("click", ".edit_employee", function(){
		var ide = $(this).attr("ide");
		window.history.pushState(new Date(), "Изменение сотрудника", "/edit_employee");
		var url = "include/edit_employee.php";
		$('.employees').addClass("current");
		$.ajax({
			type: "POST",
			url: url,
			data: "ide=" + ide,
			dataType: "html",
			cache: false,
			success: function(data) {
				$(".content").html("");
				$(".content").append(data);
			}
		});
		//Нажатие на изменить сотрудника
	});

	$(".content").on("click", ".delete_employee", function(){
		if(!confirm("Вы действительно хотите удалить сотрудника?"))
			return;
		var del = $(this);
		var id =  $(del).attr('idd');
		$.ajax({
			type: "POST",
			url: "include/delete_employee.php",
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
		//Нажатие на удалить сотрудника
	});

	$(".content").on("click", ".btn_add_employee", function(){
		var href = "/add_employee";
		window.history.pushState(new Date(), "Подразделения", href);
		check_current();
		return false;
	});

	window.onpopstate = function( e ) {
	check_current();
}

	$(".content").on("click", ".add_employee_submit", function(){
		var surname = $("#surname").val();
		var name = $("#name").val();
		var patronymic = $("#patronymic").val();
		var passport = $("#passport").val();
		var place_birth = $("#place_birth").val();
		var zagran_surname = $("#zagran_surname").val();
		var zagran_name = $("#zagran_name").val();
		var zagran_patronymic = $("#zagran_patronymic").val();
		var zagran_series_number = $("#zagran_series_number").val();
		var zagran_term = $("#zagran_term").val();

		$.ajax({
			type: "POST",
			url: "include/add_employee_script.php",
			data: "surname=" + surname + "&name=" + name + "&patronymic=" + patronymic +
			"&passport=" + passport + "&place_birth=" + place_birth + "&zagran_surname=" + zagran_surname +
			"&zagran_name=" + zagran_name + "&zagran_patronymic=" + zagran_patronymic + "&zagran_series_number=" + zagran_series_number +
			"&zagran_term=" + zagran_term,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data != 1){
					$(".success_add_employee").html("");
					$(".errors_add_employee").html(data);
				}
				else{
					$(".errors_add_employee").html("");
					$(".success_add_employee").html("Сотрудник успешно добавлен");
				}
			}
		});
	});

	$(".content").on("click", ".edit_employee_submit", function(){
		var ide = $(this).attr("ide");
		var surname = $("#surname").val();
		var name = $("#name").val();
		var patronymic = $("#patronymic").val();
		var passport = $("#passport").val();
		var place_birth = $("#place_birth").val();
		var zagran_surname = $("#zagran_surname").val();
		var zagran_name = $("#zagran_name").val();
		var zagran_patronymic = $("#zagran_patronymic").val();
		var zagran_series_number = $("#zagran_series_number").val();
		var zagran_term = $("#zagran_term").val();

		$.ajax({
			type: "POST",
			url: "include/edit_employee_script.php",
			data: "surname=" + surname + "&name=" + name + "&patronymic=" + patronymic +
			"&passport=" + passport + "&place_birth=" + place_birth + "&zagran_surname=" + zagran_surname +
			"&zagran_name=" + zagran_name + "&zagran_patronymic=" + zagran_patronymic + "&zagran_series_number=" + zagran_series_number +
			"&zagran_term=" + zagran_term + "&ide="+ide,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data != 1){
					$(".success_add_employee").html("");
					$(".errors_add_employee").html(data);
				}
				else{
					$(".errors_add_employee").html("");
					$(".success_add_employee").html("Сотрудник успешно изменен");
				}
			}
		});
	});

	$(".content").on("click", ".edit_subdivision", function(){
		var ide = $(this).attr("ide");
		window.history.pushState(new Date(), "Изменение подразделения", "/edit_subdivision");
		var url = "include/edit_subdivision.php";
		$('.subdivision').addClass("current");
		$.ajax({
			type: "POST",
			url: url,
			data: "ide=" + ide,
			dataType: "html",
			cache: false,
			success: function(data) {
				$(".content").html("");
				$(".content").append(data);
			}
		});
		//Нажатие на изменить подразделение
	});

	$(".content").on("click", ".delete_subdivision", function(){
		if(!confirm("Вы действительно хотите удалить подразделение?"))
			return;
		var del = $(this);
		var id =  $(del).attr('idd');
		$.ajax({
			type: "POST",
			url: "include/delete_subdivision.php",
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
		//Нажатие на удалить подразделение
	});

	$(".content").on("click", ".add_subdivision_submit", function(){
		var name = $("#name").val();

		$.ajax({
			type: "POST",
			url: "include/add_subdivision_script.php",
			data: "name=" + name,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data != 1){
					$(".success_add_subdivision").html("");
					$(".errors_add_subdivision").html(data);
				}
				else{
					$(".errors_add_subdivision").html("");
					$(".success_add_subdivision").html("Подразделение успешно добавлено");
				}
			}
		});
	});

	$(".content").on("click", ".edit_subdivision_submit", function(){
		var ide = $(this).attr("ide");
		var name = $("#name").val();

		$.ajax({
			type: "POST",
			url: "include/edit_subdivision_script.php",
			data: "name=" + name + "&ide="+ide,
			dataType: "html",
			cache: false,
			success: function(data) {
				if(data != 1){
					$(".success_add_subdivision").html("");
					$(".errors_add_subdivision").html(data);
				}
				else{
					$(".errors_add_subdivision").html("");
					$(".success_add_subdivision").html("Подразделение успешно измнено");
				}
			}
		});
	});

	$(".content").on("click", ".btn_add_subdivision", function(){
		var href = "/add_subdivision";
		window.history.pushState(new Date(), "Подразделения", href);
		check_current();
		return false;
	});

	$(".content").on("click", ".btn_add_trips", function(){
		var href = "/add_trips";
		window.history.pushState(new Date(), "Деловые поездки", href);
		check_current();
		return false;
	});

	$(".content").on("click", ".table_trips_line", function(){
		var id = $(this).attr("ids");
		window.history.pushState(new Date(), "Изменение подразделения", "/show_trip");
		var url = "include/show_trip.php";
		$('.trips').addClass("current");
		$.ajax({
			type: "POST",
			url: url,
			data: "ids=" + id,
			dataType: "html",
			cache: false,
			success: function(data) {
				$(".content").html("");
				$(".content").append(data);
			}
		});
	});
	var number = 1;
	var masNumbers = [];
	$(".content").on("click", ".add_services", function(){
		var type = $("#type_service").val();
		var url = "include/";
		var insertBefore = $(".insertBefore");
		switch(type){
			case "1":
				url += "avia.php";
				break;
			case "2":
				url += "jd.php";
				break;
			case "3":
				url += "avto.php";
				break;
			case "4":
				url += "hotel.php";
				break;
		}
		$.ajax({
			type: "POST",
			url: url,
			data: "",
			dataType: "html",
			cache: false,
			success: function(data) {
				var text = data.replace(/Replace/g, number.toString());
				$(text).insertBefore(insertBefore);
				masNumbers[number - 1] = number;
				number++;

			}
		});
	});

	$('.content').on("click", ".add_trip_submit", function(){
		var description = $("#description").val();
		var form = $("#form").val();
		var term = $("#term").val();
		var address = $("#address").val();
		$.ajax({
			type: "POST",
			url: "include/add_trip.php",
			data: "description=" + description + "&form=" + form + "&term=" + term + "&address=" + address,
			dataType: "html",
			cache: false,
			success: function(data) {
				var id_add = data;
				if(!isNaN(id_add)){
					alert(masNumbers);
					for(var i = 0; i < masNumbers.length; i++){
						if(masNumbers[i] == 0) continue;
						var send_data = "";
						switch($("#type" + masNumbers[i]).val()){
							case "1":
								var type_operation = $("#type_operation" + masNumbers[i]).val();
								var booking_class = $("#booking_class" + masNumbers[i]).val();
								var point_departure = $("#point_departure" + masNumbers[i]).val();
								var date_departure = $("#date_departure" + masNumbers[i]).val();
								var destination = $("#destination" + masNumbers[i]).val();
								var coment = $("#coment" + masNumbers[i]).val();
								var term_booking = $("#term_booking" + masNumbers[i]).val();
								var list_employee = $("#list_employee" + masNumbers[i]).val();
								var special_luggage = $("#special_luggage" + masNumbers[i]).val();
								send_data = "id_trips=" + id_add + "&type=1" + "&type_operation=" + type_operation + "&booking_class=" + booking_class + "&point_departure=" + point_departure + "&date_departure=" + date_departure + "&description=" + description + "&coment=" + coment + "&term_booking=" + term_booking + "&list_employee=" + list_employee + "&special_luggage=" + special_luggage;
								break;
							case "2":
								var type_operation = $("#type_operation" + masNumbers[i]).val();
								var type_allocation = $("#type_allocation" + masNumbers[i]).val();
								var point_departure = $("#point_departure" + masNumbers[i]).val();
								var date_departure = $("#date_departure" + masNumbers[i]).val();
								var destination = $("#destination" + masNumbers[i]).val();
								var coment = $("#coment" + masNumbers[i]).val();
								var list_employee = $("#list_employee" + masNumbers[i]).val();
								send_data = "id_trips=" + id_add + "&type=2" + "&type_operation=" + type_operation + "&type_allocation=" + type_allocation + "&point_departure=" + point_departure + "&date_departure=" + date_departure + "&destination=" + destination + "&coment=" + coment + "&list_employee=" + list_employee;
								break;
							case "3":
								var type_operation = $("#type_operation" + masNumbers[i]).val();
								var point_departure = $("#point_departure" + masNumbers[i]).val();
								var date_departure = $("#date_departure" + masNumbers[i]).val();
								var destination = $("#destination" + masNumbers[i]).val();
								var coment = $("#coment" + masNumbers[i]).val();
								var list_employee = $("#list_employee" + masNumbers[i]).val();
								send_data = "id_trips=" + id_add + "&type=3" + "&type_operation=" + type_operation + "&point_departure=" + point_departure + "&date_departure=" + date_departure + "&destination=" + destination + "&coment=" + coment + "&list_employee=" + list_employee;
								break;
							case "4":
								var city = $("#city" + masNumbers[i]).val();
								var district_residence = $("#district_residence" + masNumbers[i]).val();
								var date_s = $("#date_s" + masNumbers[i]).val();
								var date_po = $("#date_po" + i).val();
								var accommodation_category = $("#accommodation_category" + masNumbers[i]).val();
								var food_option = $("#food_option" + masNumbers[i]).val();
								var term_booking = $("#term_booking" + masNumbers[i]).val();
								var list_employee = $("#list_employee" + masNumbers[i]).val();
								send_data = "id_trips=" + id_add + "&type=4" + "&city=" + city + "&district_residence=" + district_residence + "&date_s=" + date_s + "&date_po=" + date_po + "&accommodation_category=" + accommodation_category + "&food_option=" + food_option + "&term_booking=" + term_booking + "&list_employee=" + list_employee;
								break;
						}
					$.ajax({
			type: "POST",
			url: "include/add_services.php",
			data: send_data,
			dataType: "html",
			cache: false,
			success: function(data_services) {

				}
			});
				}
				number = 1;
			}
			}
		});
	});

	$(".content").on("click", ".del_services", function(){
		var id_del = $(this).attr("id_del");
		masNumbers[id_del - 1] = 0;
		$(".block_services" + id_del).remove();
	});

	var pull = $('#pull');
        menu = $('nav ul');
        menuHeight  = menu.height();
    $(pull).on('click', function(e) {
        e.preventDefault();
        menu.slideToggle();
    });

		$(window).resize(function(){
	     var w = $(window).width();
	     if(w > 320 && menu.is(':hidden')) {
	         menu.removeAttr('style');
	     }
	 });

});
