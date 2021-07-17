<?php

include 'conndb.php';

extract($_POST);

if(isset($_POST['program_code']))
{
  if(isset($_POST['program_code']))
  {$program_code = strtoupper(trim($_POST['program_code']));}

  if(isset($_POST['semester']))
  {$semester = trim($_POST['semester']);}

  if(isset($_POST['college']))
  {$college = strtoupper(trim($_POST['college']));}

  if(isset($_POST['webhook_link']))
  {$webhook_link = strtolower(trim($_POST['webhook_link']));}

  if(isset($_POST['period']))
  {$period = $_POST['period'];}

  if(isset($_POST['year']))
  {$year = $_POST['year'];}

  $period .= $year;


  $query = "INSERT INTO query (program_code,semester,college,webhook_link,period,timestamp) values ('$program_code','$semester','$college','$webhook_link','$period',date('Y-m-d H-i-s'))";

//   if(mysqli_query($conn,$query)){
// 	$msg='Request recorded successfully ! Sit back and relax. No more anxiously checking for results. :)';
//   }
// 	else{
// 	$msg='Error. Please try again';
//   }
// }
  if ($conn->query($query) === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

elseif (isset($_POST['starry']))
{
  $starry = join("','",$starry);
  $data='';

  $query = " SELECT * from query WHERE id in ('$starry') ORDER by id";
  $result = mysqli_query($conn,$query);

  if(mysqli_num_rows($result) > 0){

    while ($row = mysqli_fetch_array($result)) {

      $data .= '<div class="card bg-white col-md-5 shadow border-light m-4 target">
		    			<div class="card-body">
							<h6 class="">Program Code - <span class="font-weight-bold">'.$row['program_code'].'</span></h6>
              <p>Sem - '.$row['semester'].' '.$row['college'].'</p><hr>
							<p></p>
              <span class="d-flex justify-content-center"><button type="button" onclick="remove_query('.$row['id'].')" class="btn btn-danger btn-sm">Remove</button></span>
							</div></div>
							';
		}
	}
    	echo $data;
}

elseif (isset($_POST['id']))
{
  $id = $_POST['id'];

  $query = " DELETE from query WHERE id = '$id'";
  $result = mysqli_query($conn,$query);

}

elseif (isset($_POST['all']))
{
  $all = join("','",$all);

  $query = " DELETE from query WHERE id in ('$all') ";
  $result = mysqli_query($conn,$query);
}
?>
