<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kashana Contact Page</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<style>
		.error { color: #ff4500; }
		.topBox { margin:16%; }
	</style>

</head>

<body>
		<div class="container-fluid"> 
			<div class="row">
				 <div class="col-lg-7 col-md-7 col-12 m-auto">
				 	<div class="card topBox">
				 		<div class="card-header text-danger font-weight-bold">Contact Form</div>
				 		<div class="card-body">
				 			<form id="contactForm" method="post">
				 				@csrf
							   <div class="form-row">
							  	<div class="form-group col-md-12">
							    <label>Name</label>
							    <input type="text" class="form-control" name="name"  placeholder="Kashana">
							  </div>

							    <div class="form-group col-md-6">
							      <label>Email</label>
							      <input type="email" class="form-control" name="email" placeholder="kashana@gmail.com">
							    </div>

							     <div class="form-group col-md-6">
							      <label>Mobile Number</label>
							      <input type="number" class="form-control" name="phone" placeholder="1234567890">
							    </div>

							    <div class="form-group col-md-12">
							    <label>Message</label>
							    <textarea class="form-control" name="message"> </textarea>
							  </div>
							  </div>
							  
							  <button type="submit" id="subBtn" class="btn btn-primary">Sign in</button>
						    </form>
				 		</div>
				 	</div>
				 		

				 </div>
			</div>
		</div>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

		<script>
		$('#contactForm').validate({
		    rules: {
		        name: {
		            maxlength:250,
		            required: true,
		        },
		        email: {
		            maxlength:250,
		            required: true,
		        },
		        phone: {
		            required: true,
		            digits: true,
                    minlength: 9,
                    maxlength: 11,
		        },
		        message: {
		            maxlength:1000,
		            required: true,
		        }
		    },
		    messages:{
		        name:{
		            required: 'Name is required.'
		        },
		        email:{
		            required: 'Email is required.'
		        },
		        phone:{
		            required: 'Mobile Number is required.'
		        },
		        message:{
		            required: 'Message is required.'
		        },
		    },
		    submitHandler: function(form,event) {
		      event.preventDefault(); 
		       $.ajax({
		           type: $(form).attr('method'),
		           url: "{{route('contact_store')}}",
		           async: false,
		           data:$(form).serialize(),
		           dataType: 'json',
		           beforeSend: function () {
		           		$("#subBtn").attr("disabled",true);
		           },
		           success: function(data) {
		           	   if(data.status==true)
		               $.notify(data.msg, "success");

		           	   if(data.status==false)
		               $.notify(data.msg, "error");
		           },
		           error: function(error) {
	                   $.notify("Something went wrong", "error");
	               },
	               complete: function () {
	               		$('#contactForm').trigger("reset");
		           		$("#subBtn").attr("disabled",false);
		           },
		       });
		    }

		});
	 </script>

</body>
</html>

