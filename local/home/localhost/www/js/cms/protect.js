function CSRF(a){this.token=a;this.protectForms=function(){jQuery("form").append('<input type="hidden" name="csrf" value="'+this.token+'" />');return true};this.getToken=function(){return this.token};this.changeToken=function(b){this.token=b;jQuery('form input[name="csrf"]').val(b)};this.setAjaxSettings=function(){jQuery.ajaxSetup({beforeSend:function(c,b){if(b.type=="POST"&&b.data){data=b.data.match(/csrf=([^&]*)/);if(!data){b.data+="&csrf="+csrfProtection.token}else{if(data[1]==""){b.data=b.data.replace(/csrf=[^&]*/,"csrf="+csrfProtection.token)}}}}})}};