$(document).ready(function() {
		var flag = 0;
		read_queries(starry);
		$('[data-toggle="tooltip"]').tooltip();
});

var starry=[];
if(Cookies.get('stored')==undefined)
{
	Cookies.set('stored','',{ expires: 183 });
}
starry=Cookies.get('stored').split(',');
// console.log(starry);

// Diplay past queries
function read_queries(starry){
	// console.log(starry);
	$.ajax({
		url : "index_db.php",
		type : "post",
		data :{ starry : starry },
		success:function(data,success){
			$('.resultinfo').html(data);  }
	});
}

// Add query to cookie
function add_query(last_id) {
		// console.log(last_id);
		last_id = last_id.toString();
		if(!starry.includes(last_id)) {
		starry.push(last_id);
		// console.log(starry);
		Cookies.set('stored',starry,{ expires: 183 });
		// alert(Cookies.get('stored'));
		read_queries(starry);
		}
}

// remove query(s) from cookie
function remove_query(id){
	if(id == 'all'){
		Cookies.remove('stored');
		$('#del_acknowledge').addClass('alert-primary').html('All Alerts Removed!').fadeIn();;
		$('#del_acknowledge').fadeOut(5000);
		// console.log(Cookies.get('stored'));
		$.ajax({
			url : "index_db.php",
			type : "post",
			data :{ all : starry },
			success:function(data,success){
				starry.length = 0;
				read_queries(starry);  }
		});
	}
	else {
		var pos =  starry.indexOf(id.toString());
		if(pos != -1){
		starry.splice( pos, 1 );
		Cookies.set('stored',starry,{expires:183});
		$('#del_acknowledge').addClass('alert-primary').html('Alert Removed!').fadeIn();
		$('#del_acknowledge').fadeOut(5000);
		// console.log(starry);
		$.ajax({
			url : "index_db.php",
			type : "post",
			data :{ id : id },
			success:function(data,success){
				read_queries(starry);  }
		});
		}
	}
}

function validateProgcode(){
	var prog_code = $('#program_code').val();
	if (prog_code==null || prog_code==""){
		document.getElementById("progcodeerror").innerHTML = 'Program code is required';
		$('#program_code').addClass('border border-danger')
		flag = 1;
	}
	else if (prog_code.length != 7){
		document.getElementById("progcodeerror").innerHTML = 'Program code should be a 7 digit alphanumeric code';
		$('#program_code').addClass('border border-danger')
		flag = 1;
	}
	else{
		document.getElementById("progcodeerror").innerHTML = '';
		$('#program_code').removeClass('border border-danger')
		flag = 0;
	}
}

function validateSem(){
	var semester = $('#semester').val();
	if( semester < 1 || semester > 8 ){
		document.getElementById("semerror").innerHTML = 'Semester should be between 1 and 8';
		$('#semester').addClass('border border-danger')
		flag = 1;
	}
	else{
		document.getElementById("semerror").innerHTML = '';
		$('#semester').removeClass('border border-danger')
		flag = 0;
	}
}
function validateWebhook() {
	var webhook_link = $('#webhook_link').val();
	if (webhook_link==null || webhook_link==""){
		document.getElementById("webhookerror").innerHTML = 'Cannot send alert to discord channel without webhook link';
		$('#webhook_link').addClass('border border-danger')
		flag = 1;
	}
	else{
		document.getElementById("webhookerror").innerHTML = '';
		$('#webhook_link').removeClass('border border-danger')
		flag = 0;
	}
}


$( "form" ).on( "submit", function(e) {
	// console.log('we are in');
	e.preventDefault();
	if (flag == 0) {

	if (starry.length < 4) {

	// console.log('more in');
	var dataString = $(this).serialize();
	// console.log(dataString);

		$.ajax({
		type: "POST",
		url: "index_db.php",
		data: dataString,
		success: function (data,status) {
			$("#acknowledge").addClass('alert-success').html('Request recorded successfully ! Sit back and relax. No more anxiously checking for results. :)').fadeIn();
			$("#acknowledge").fadeOut(5000);
			// console.log(data);
			add_query(data);
		}
	});
	}
	else {
		alert('Only 3 alerts allowed per user');
	}
}
});
