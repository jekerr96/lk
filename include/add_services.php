<?
$type = $_POST["type"];
$query = "";
var_dump($_POST);
switch($type){
	case 1:
		$id_trips = $_POST["id_trips"];
		$type_operation = $_POST["type_operation"];
		$booking_class = $_POST["booking_class"];
		$point_departure = $_POST["point_departure"];
		$date_departure = $_POST["date_departure"];
		$destination = $_POST["destination"];
		$coment = $_POST["coment"];
		$term_booking = $_POST["term_booking"];
		$list_employee = $_POST["list_employee"];
		$special_luggage = $_POST["special_luggage"];

		$query = "INSERT INTO services (type, id_trips, type_operation, booking_class, point_departure, date_departure, destination, coment, term_booking, id_employee, special_luggage) VALUES (1, $id_trips, $type_operation, $booking_class, '$point_departure', '$date_departure', '$destination', '$coment', '$term_booking', '$list_employee', '$special_luggage')";
		break;
	case 2:
		$id_trips = $_POST["id_trips"];
		$type_operation = $_POST["type_operation"];
		$type_allocation = $_POST["type_allocation"];
		$point_departure = $_POST["point_departure"];
		$date_departure = $_POST["date_departure"];
		$destination = $_POST["destination"];
		$coment = $_POST["coment"];
		$list_employee = $_POST["list_employee"];

		$query = "INSERT INTO services (type, id_trips, type_operation, type_allocation, point_departure, date_departure, destination, coment, id_employee) VALUE (2, $id_trips, $type_operation, $type_allocation, '$point_departure', '$date_departure', '$destination', '$coment', '$list_employee')";
		break;
	case 3:
		$id_trips = $_POST["id_trips"];
		$type_operation = $_POST["type_operation"];
		$point_departure = $_POST["point_departure"];
		$date_departure = $_POST["date_departure"];
		$destination = $_POST["destination"];
		$coment = $_POST["coment"];
		$list_employee = $_POST["list_employee"];

		$query = "INSERT INTO services (type, id_trips, type_operation, point_departure, date_departure, destination, coment, id_employee) vALUES (3, $id_trips, $type_operation, '$point_departure', '$date_departure', '$destination', '$coment', '$list_employee')";
		break;
	case 4:
		$id_trips = $_POST["id_trips"];
		$city = $_POST["city"];
		$district_residence = $_POST["district_residence"];
		$date_s = $_POST["date_s"];
		$date_po = $_POST["date_po"];
		$accommodation_category = $_POST["accommodation_category"];
		$food_option = $_POST["food_option"];
		$term_booking = $_POST["term_booking"];
		$list_employee = $_POST["list_employee"];

		$query = "INSERT INTO services (type, id_trips, city, district_residence, date_s, date_po, accommodation_category, food_option, term_booking, id_employee) VALUES (4, $id_trips, '$city', '$district_residence', '$date_s', '$date_po', '$accommodation_category', $food_option, '$term_booking', '$list_employee')";
		break;
	}
		include 'db_connect.php';
	$result = mysqli_query($link, $query);
	if(!$result)
		echo $query;
?>