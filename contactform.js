jQuery(document).ready(function($) {
  "use strict";
	var state="contacts";
  //Contact
  $('form.contactForm').submit(function() {
	  //alert(state);
      var f = $(this).find('.form-group'),
      ferror = false,
      emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

    f.children('input').each(function() { // run all inputs

      var i = $(this); // current input
      var rule = i.attr('data-rule');
		
      if (rule !== undefined) {
        var ierror = false; // error flag for current input
        var pos = rule.indexOf(':', 0);
        if (pos >= 0) {
          var exp = rule.substr(pos + 1, rule.length);
          rule = rule.substr(0, pos);
        } else {
          rule = rule.substr(pos + 1, rule.length);
        }

        switch (rule) {
          case 'required':
            if (i.val() === '') {
              ferror = ierror = true;
            }
            break;

          case 'minlen':
            if (i.val().length < parseInt(exp)) {
              ferror = ierror = true;
            }
            break;

          case 'phone':
            if (i.val().length < parseInt(exp) || i.val()[0]!='+') {
              ferror = ierror = true;
            }
            break;

          case 'email':
            if (!emailExp.test(i.val())) {
              ferror = ierror = true;
            }
            break;

          case 'checked':
            if (! i.is(':checked')) {
              ferror = ierror = true;
            }
            break;

          case 'regexp':
            exp = new RegExp(exp);
            if (!exp.test(i.val())) {
              ferror = ierror = true;
            }
            break;
        }
        i.next('.validation').html((ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
      }
    });
    f.children('textarea').each(function() { // run all inputs

      var i = $(this); // current input
      var rule = i.attr('data-rule');

      if (rule !== undefined) {
        var ierror = false; // error flag for current input
        var pos = rule.indexOf(':', 0);
        if (pos >= 0) {
          var exp = rule.substr(pos + 1, rule.length);
          rule = rule.substr(0, pos);
        } else {
          rule = rule.substr(pos + 1, rule.length);
        }

        switch (rule) {
          case 'required':
            if (i.val() === '') {
              ferror = ierror = true;
            }
            break;

          case 'minlen':
            if (i.val().length < parseInt(exp)) {
              ferror = ierror = true;
            }
            break;
			
          case 'phone':
            if (i.val().length < parseInt(exp) || i.val()[0]!='+') {
              ferror = ierror = true;
            }
            break;
        }
        i.next('.validation').html((ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
      }
    });
    if (ferror) return false;
    else var str = $(this).serialize();
    var action = $(this).attr('action');
    if( ! action ) {
      action = 'contactform.php';
    }
    $.ajax({
      type: "POST",
      url: action,
      data: str+'&state='+state,
      success: function(msg) {
        //alert(msg);
        if (msg == 'OK') {
		  //$('.contactForm').find("input, text").val("");		  
		  if (state=="presentation"){
			var link = document.createElement('a');
			link.setAttribute('href','https://devmooc.kz/unigroup/unigroupkz.pdf');
			link.setAttribute('download','download');
			link.setAttribute('target','_blank');
			link.setAttribute('title','Presentation');
			link.click();
			
			$("#pdfmessage").addClass("show");
		  } else{
			  $("#sendmessage").addClass("show");
			  $("#errormessage").removeClass("show");
		  }
		  
        } else {
          $("#sendmessage").removeClass("show");
          $("#errormessage").addClass("show");
          $('#errormessage').html(msg);
        }

      }
    });
    return false;
  });

    $("#submitContacts").click(function(){ 
		//alert("submit Contacts!");
        state="contact"; // Submit the form
    });

    $("#submitPresentation").click(function(){ 
		//alert("dowload Presentation!");
        state="presentation"; // Submit the form
    });
	
	 $( '#submitPresentationBox' ).on( 'click', 'button', function () { state="presentation"; });


});
