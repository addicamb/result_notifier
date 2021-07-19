<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- <meta name="google-signin-client_id" content="538244115643-4oen2qh08rjjl3197k7g1m80btc9t5jq.apps.googleusercontent.com"> -->
  	<link rel="icon" href="images/mu.jpg" sizes="16x16">
    <link rel="stylesheet" href="styles.css">

  	<title>Results Alert</title>

  	<!-- bootstrap CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- icons library -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style media="screen">
    ol.list-group {
        list-style: decimal inside;
    }

    .list-group-item {
        display: list-item;
    }
    body{
    /* background: -webkit-linear-gradient(left,   #0072ff, #00c6ff); */
    background-color: #f2f2f2;
    }
    div.container{
      background: #fff;
    }
    </style>
  </head>
  <body>
    <div class="container p-4 mt-5 mb-5 shadow">
      <div class="row m-1">
        <p><h4>Mumbai University Result Notification</h4></p>
      </div>
      <div class="row m-1"
        <p>(Get a notification alert on your discord channel when your result arrives)</p>
      </div>
      <hr>
      <div class="row m-0">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#alerts">Alerts History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#tutorial" id='third_tab'>Discord Webhook - How to</a>
        </li>
      </ul>
      </div>
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
          <!-- <h3>Home</h3> -->
          <form action="" name = 'details'>

         		<div class="form-group col-sm-12 col-md-5 ">
               <label class="font-weight-bold" for="program_code">Program code <span style="color:red">*</span> <a href="#" data-toggle="tooltip"  title="Check Exam no. in your Hall ticket"><i class="fas fa-info-circle text-primary small" title=""></i></a></label>

               <input class="form-control shadow text-uppercase" type="text" onblur="validateProgcode()" name="program_code" id="program_code" placeholder="eg. 1T00728 for Computer Engineering">
               <p class = "text-danger font-italic" id="progcodeerror"></p>
         		</div>

         		<div class="form-group col-sm-12 col-md-4 ">
               <label class="font-weight-bold" for="semester">Semester <span class="small">(1-8) </span><span style="color:red">*</span></label>

         			<input class="form-control shadow" type="number" name="semester" onblur="validateSem()" id="semester" placeholder="eg. 8">
               <p class = "text-danger font-italic" id="semerror"></p>
         		</div>

             <div class="form-group col-sm-12 col-md-4 ">
               <label class="font-weight-bold" for="college">College <span style="color:red">* </span><a href="#" data-toggle="tooltip" data-placement="right" title='short-form code of your college, eg: RAIT for Ramrao Adik Institute of Technology'><i class="fas fa-info-circle text-primary small" ></i></a></label>

         			<input class="form-control shadow text-uppercase" type="text" name="college" id="college" title="" placeholder="eg. SIES">
         		</div>

             <div class="form-group col-sm-12 col-md-4 ">
               <label class="font-weight-bold" for="firstname">Webhook Link to your discord channel <span style="color:red">* </span><a data-toggle="tooltip" title="Click on me" onclick="$('#third_tab').trigger('click')"><i class="fas fa-question-circle text-primary small" ></i></a></label>

         			<textarea class="form-control shadow" name="webhook_link" onblur="validateWebhook()" id="webhook_link" placeholder="discord webhook link"></textarea>
               <p class = "text-danger font-italic" id="webhookerror"></p>
         		</div>

             <div class="form-group col-sm-12 col-md-4 ">
               <label class="font-weight-bold" for="period">Semester period <span style="color:red">*</span></label>
         			<select class="form-control mt-1 shadow" name="period" id="period">
         				<option value="F">First-Half of the year (January-May)</option>
         				<option value="S">Second-Half of the year (July-December)</option>
         			</select>
         		</div>

             <div class="form-group col-sm-12 col-md-4 ">
               <label class="font-weight-bold" for="year">Year of exam <span style="color:red">*</span></label>
         			<select class="form-control mt-1 shadow" name="year" id="year">
         				<option value="20">2020</option>
         				<option value="21" selected>2021</option>
         			</select>
         		</div>

         		<input type="submit" name="submit" id="submit_btn" class="btn btn-primary ml-3 mt-1 shadow" value="Alert me!">
   	     </form>
         <div id='soft_warn' class='ml-3 mt-3' style="color:red">

         </div>
   	      <div class="alert mt-3" id = 'acknowledge'>

          </div>

        </div>

        <div id="alerts" class="container tab-pane fade"><br>

          <div class="row">
        	<h3 class="ml-2">Alerts</h3>
          <button type="button" class="btn btn-sm btn-danger  ml-auto mr-2 font-weight-bold" onclick="remove_query('all')">Remove All</button>
          </div>
          <hr>
          <div class="row resultinfo">


          </div>
          <p class="alert m-2 d-flex" id="del_acknowledge"></p>

        </div>

        <div id="tutorial" class="container tab-pane fade"><br>

          <a href="https://support.discord.com/hc/en-us/articles/228383668-Intro-to-Webhooks" target="_blank" class="text-dark"> <i class="fas fa-info-circle m-2" ></i></a><em>Webhooks are a simple way to post messages from other apps and websites into Discord using internet magic. </em>
          <hr>
          <h3 class="m-2">Create Webhook</h3>
          <h6 class="m-2">( How to create a webhook in your discord channel )</h6>

          <ol class="list-group">
            <li class="list-group-item">Open the Discord <strong>Desktop app</strong> on your PC or laptop. If you don't have it, you can get it from <a href="https://discord.com/download" target="_blank">here</a>.</li>
            <li class="list-group-item">Right click on your discord server (group) where you want to receive Result alert notification message and select <strong>Server Settings</strong>. <em>(You need to be an admin of the server to create the webhook)</em></li>
            <!-- <li class="list-group-item">Right click on any one of the text channels (#general) and select <strong>Edit channel</strong>.</li> -->
            <li class="list-group-item">Click on <strong>Integrations</strong> in the left panel.</li>
            <li class="list-group-item">Click the <strong>Create Webhook</strong> button.
              <ul>
                <li class="m-2"><strong>Choose what channel the Webhook posts to : </strong>&nbsp; By selecting the desired text channel in the dropdown menu.</li>
                <li class="m-2"><strong>Edit the avatar : </strong> <i>(optional)</i>&nbsp; By clicking the avatar next to the Name in the top left</li>
                <li class="m-2"><strong>Name your Webhook : </strong> <i>(optional)</i>&nbsp; Good for distinguishing multiple webhooks for multiple different services.</li>
                </ul>
            </li>
            <li class="list-group-item">Note the URL from the <strong>Copy Webhook URL</strong> field.</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- jquery js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- cookie js -->
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
    <!-- popper js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- external js -->
    <script src="master.js"></script>
  </body>
</html>
