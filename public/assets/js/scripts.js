$(function () {
	$("#additionalInsured").hide();
	$("#additionalTitle").hide();
	$("#errors").hide();

    function formToArray(form){
	    var num_array = form.serializeArray();
	    var assoc_array = {};

	    $.map(num_array, function(n, i){
	        assoc_array[n['name']] = n['value'];
	    });

    	return assoc_array;
	}
	
	function validName(name) {
		if (name.length == 0) {
			return false;
		}

   		if (name[0] != name[0].toUpperCase()) {
	   		return false;
	   	}
   		for (var i = 1; i < name.length; i++) {
	   		if (name[i] != name[i].toLowerCase()) {
		   		return false;
		   	}
	   	}
	   	
	   	return true;
   	}
   	
   	function validDate(date) {
		if (date.length == 0) {
			return false;
		}

   	   	if (date.trim().length == 0) {
			return false;
		}
		
		return true;
	   }
	   
	function validEmail(email) {
		if (email.length == 0) {
			return false;
		}

		var emailRegex = /[\w\.]+@[\w]+.[\w]{2,6}/;
		return emailRegex.test(email);
	}

	function validNumber(number, numberLength) {
		if (number.length == 0) {
			return false;
		}

		if (number.length > numberLength || isNaN(number)) {
			return false;
		}

		return true;
	}
   	
    $("#birthdate").datepicker({
        changeMonth: true,
		changeYear: true,
        dateFormat: 'yy-mm-dd',
        maxDate: '-1d',
        yearRange: '-100y:c+nn',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#birthdate").datepicker("option", "maxDate", "yearRange", "-100y:c+nn");
        }
	});
	$("#birthdate_insured").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        maxDate: '-1d',
        yearRange: '-100y:c+nn',
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#birthdate_insured").datepicker("option", "maxDate", "yearRange", "-100y:c+nn");
        }
    });
    $("#date_from").datepicker({
        numberOfMonths: 1,
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#date_to").datepicker("option", "minDate", dt);
        }
    });
    $("#date_to").datepicker({
        numberOfMonths: 1,
        dateFormat: "yy-mm-dd",
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#date_from").datepicker("option", "maxDate", dt);
        }
	});
	
		var additionalForm = '' +
		'<form class="additional">' +
		'<div class="form-group row">' +
			'<label class="col-lg-3 col-form-label form-control-label">First name <span class="text-danger">*</span></label>' +
			'<div class="col-lg-9">' +
				'<input type="text" class="form-control" name="first_name" placeholder="" value="" required="">' +
			'</div>' +
		'</div>' +
		'<div class="form-group row">' +
			'<label class="col-lg-3 col-form-label form-control-label">Last name <span class="text-danger">*</span></label>' +
			'<div class="col-lg-9">' +
				'<input type="text" class="form-control" name="last_name" placeholder="" value="" required="">' +
			'</div>' +
		'</div>' +
		'<div class="form-group row">' +
			'<label class="col-lg-3 col-form-label form-control-label">Birthdate <span class="text-danger">*</span></label>' +
			'<div class="col-lg-9">' +
				'<input class="form-control" type="text" value="" id="birthdate_insured" name="birthdate" autocomplete="off">' +
			'</div>' +
		'</div>' +
		'<div class="form-group row">' +
			'<label class="col-lg-3 col-form-label form-control-label">Passport ID <span class="text-danger">*</span></label>' +
			'<div class="col-lg-9">' +
				'<input type="text" class="form-control" name="passport_id" placeholder="" required="">' +
			'</div>' +
		'</div>' +
		'</form><hr>';

    $("#additionalInsured").click(function(e) {
		e.preventDefault();
		$("#forms").append(additionalForm);
	});

	$('#group').change(
		function(){
			if ($(this).is(':checked')) {
				$("#forms").append(additionalForm);
				$("#additionalInsured").show();
				$("#additionalTitle").show();
			}
	});

	$('#individual').change(
		function(){
			if ($(this).is(':checked')) {
				$("#forms").html("");
				$("#additionalInsured").hide();
				$("#additionalTitle").hide();
			}
	});
    
    $("#main").submit(function(event) {
    	event.preventDefault();
    	var policy_json = formToArray($("#main"));
    	var additional = [];
    	$(".additional").each(function(indeks) {
    		additional.push(formToArray($(this)));
    	});
        policy_json["additional"] = additional;
		
		var errors = "";
		
		for (var data in policy_json) {
			switch(data){
				case "first_name":
				case "last_name":
					if (!validName(policy_json[data])) {
						errors += "First name or last name is invalid. First letter must be uppercase.<br>";
				   	}
					break;
				case "birthdate":
				case "date_from":
				case "date_to":
					if (!validDate(policy_json[data])) {
				   		errors += "Date must be filled in.<br>";
				   	}
					break;
				case "email":
					if (!validEmail(policy_json[data])) {
						errors += "Invalid email.<br>";
					}
					break;

				case "passport_id":
						if (!validNumber(policy_json[data], 9)) {
							errors += "Invalid passport id.";
						}
						break;
				case "phone":
					if (!validNumber(policy_json[data], 10)) {
						errors += "Invalid phone number.";
					}
					break;
			}			
        }
        if(errors == '') {
            $("#final_data").val(JSON.stringify(policy_json));
            document.getElementById("final_form").submit();
        } else {
			$("#errors").show();
			$("#errors p").html(errors);
			document.getElementById("top").scrollIntoView({
				behavior: "smooth"
			});
		}          	
    })
});