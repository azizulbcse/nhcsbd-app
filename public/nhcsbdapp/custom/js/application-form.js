$(document).ready(function() {
	// main menu
	$("#navSetting").addClass('active');
	// sub manin
	$("#topNavSetting").addClass('active');

	$("#ApplicationForm").unbind('submit').bind('submit', function() {

		var form = $(this);

		$(".text-danger").remove();

		var BkashNogod           = $("#BkashNogod").val();
		var TransactionNo        = $("#TransactionNo").val();
		var ApplicantNameBangla  = $("#ApplicantNameBangla").val();
		var ApplicantNameEnglish = $("#ApplicantNameEnglish").val();
		var FathersName          = $("#FathersName").val();
		var MothersName          = $("#MothersName").val();
		var Gender               = $("#Gender").val();
		var MaritalStatus        = $("#MaritalStatus").val();
		var DateofBirth          = $("#DateofBirth").val();
		var Age                  = $("#Age").val();
		var PresentAddress       = $("#PresentAddress").val();
		var PermanentAddress     = $("#PermanentAddress").val();
		var HospitalName         = $("#HospitalName").val();
		var MobileNo             = $("#MobileNo").val();
		var AppNID               = $("#AppNID").val();
		var Email                = $("#Email").val();
		var BloodGroup           = $("#BloodGroup").val();
		var NomineeName          = $("#NomineeName").val();
		var NomineeRelation      = $("#NomineeRelation").val();
		var NomineeMobile        = $("#NomineeMobile").val();
		var NomineeAddress       = $("#NomineeAddress").val();
		var EmergencyContact     = $("#EmergencyContact").val();


		if(BkashNogod == "" || TransactionNo == "" || ApplicantNameBangla == "" || ApplicantNameEnglish == "" || FathersName == "" || MothersName == "" || Gender == "" || MaritalStatus == "" || DateofBirth == "" || Age == "" || PresentAddress == "" || PermanentAddress == ""
		|| HospitalName == "" || MobileNo == "" || AppNID == "" || Email == "" || BloodGroup == "" || NomineeName == "" || NomineeRelation == "" || NomineeMobile == "" || NomineeAddress == "" || EmergencyContact == "") 
		{
		    if(BkashNogod == "") {
				$("#BkashNogod").after('<p class="text-danger">The Bkash/Nogod field is required</p>');
				$("#BkashNogod").closest('.form-group').addClass('has-error');
			} else {
				$("#BkashNogod").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(TransactionNo == "") {
				$("#TransactionNo").after('<p class="text-danger">The Transaction No field is required</p>');
				$("#TransactionNo").closest('.form-group').addClass('has-error');
			} else {
				$("#TransactionNo").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}
			
			if(ApplicantNameBangla == "") {
				$("#ApplicantNameBangla").after('<p class="text-danger">The Applicant Name Bangla field is required</p>');
				$("#ApplicantNameBangla").closest('.form-group').addClass('has-error');
			} else {
				$("#ApplicantNameBangla").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(ApplicantNameEnglish == "") {
				$("#ApplicantNameEnglish").after('<p class="text-danger">The Applicant Name English field is required</p>');
				$("#ApplicantNameEnglish").closest('.form-group').addClass('has-error');
			} else {
				$("#ApplicantNameEnglish").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(FathersName == "") {
				$("#FathersName").after('<p class="text-danger">The Fathers Name English field is required</p>');
				$("#FathersName").closest('.form-group').addClass('has-error');
			} else {
				$("#FathersName").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(MothersName == "") {
				$("#MothersName").after('<p class="text-danger">The Mothers Name English field is required</p>');
				$("#MothersName").closest('.form-group').addClass('has-error');
			} else {
				$("#MothersName").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(Gender == "") {
				$("#Gender").after('<p class="text-danger">The Gender field is required</p>');
				$("#Gender").closest('.form-group').addClass('has-error');
			} else {
				$("#Gender").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(MaritalStatus == "") {
				$("#MaritalStatus").after('<p class="text-danger">The Marital Status field is required</p>');
				$("#MaritalStatus").closest('.form-group').addClass('has-error');
			} else {
				$("#MaritalStatus").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(DateofBirth == "") {
				$("#DateofBirth").after('<p class="text-danger">The Date of Birth field is required</p>');
				$("#DateofBirth").closest('.form-group').addClass('has-error');
			} else {
				$("#DateofBirth").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(Age == "") {
				$("#Age").after('<p class="text-danger">The Age field is required</p>');
				$("#Age").closest('.form-group').addClass('has-error');
			} else {
				$("#Age").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(PresentAddress == "") {
				$("#PresentAddress").after('<p class="text-danger">The Present Address field is required</p>');
				$("#PresentAddress").closest('.form-group').addClass('has-error');
			} else {
				$("#PresentAddress").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(PermanentAddress == "") {
				$("#PermanentAddress").after('<p class="text-danger">The Permanent Address field is required</p>');
				$("#PermanentAddress").closest('.form-group').addClass('has-error');
			} else {
				$("#PermanentAddress").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(HospitalName == "") {
				$("#HospitalName").after('<p class="text-danger">The Hospital Name field is required</p>');
				$("#HospitalName").closest('.form-group').addClass('has-error');
			} else {
				$("#HospitalName").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(MobileNo == "") {
				$("#MobileNo").after('<p class="text-danger">The Mobile No field is required</p>');
				$("#MobileNo").closest('.form-group').addClass('has-error');
			} else {
				$("#MobileNo").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(AppNID == "") {
				$("#AppNID").after('<p class="text-danger">The NID field is required</p>');
				$("#AppNID").closest('.form-group').addClass('has-error');
			} else {
				$("#AppNID").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(Email == "") {
				$("#Email").after('<p class="text-danger">The Email field is required</p>');
				$("#Email").closest('.form-group').addClass('has-error');
			} else {
				$("#Email").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(BloodGroup == "") {
				$("#BloodGroup").after('<p class="text-danger">The Blood Group field is required</p>');
				$("#BloodGroup").closest('.form-group').addClass('has-error');
			} else {
				$("#BloodGroup").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(NomineeName == "") {
				$("#NomineeName").after('<p class="text-danger">The Nominee Name field is required</p>');
				$("#NomineeName").closest('.form-group').addClass('has-error');
			} else {
				$("#NomineeName").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(NomineeRelation == "") {
				$("#NomineeRelation").after('<p class="text-danger">The Nominee Relation field is required</p>');
				$("#NomineeRelation").closest('.form-group').addClass('has-error');
			} else {
				$("#NomineeRelation").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(NomineeMobile == "") {
				$("#NomineeMobile").after('<p class="text-danger">The Nominee Mobile No field is required</p>');
				$("#NomineeMobile").closest('.form-group').addClass('has-error');
			} else {
				$("#NomineeMobile").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(NomineeAddress == "") {
				$("#NomineeAddress").after('<p class="text-danger">The Nominee Address No field is required</p>');
				$("#NomineeAddress").closest('.form-group').addClass('has-error');
			} else {
				$("#NomineeAddress").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}

			if(EmergencyContact == "") {
				$("#EmergencyContact").after('<p class="text-danger">The Emergency Contact field is required</p>');
				$("#EmergencyContact").closest('.form-group').addClass('has-error');
			} else {
				$("#EmergencyContact").closest('.form-group').removeClass('has-error');
				$(".text-danger").remove();
			}			

		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					console.log(response);
					if(response.success == true) {
						$('.ApplicationFormMessage').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	    
					} else {

						$('.ApplicationFormMessage').html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-warning").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          	
					}
				} // /success function
			}); // /ajax function

		} // /else

		return false;
	});
}); // /document