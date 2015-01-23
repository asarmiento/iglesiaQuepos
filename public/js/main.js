var loadingUI = function (message){
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: 0.5,
        color: '#fff'
    }, message: '<h2><img style="margin-right: 30px" src="' + server + 'img/spiffygif.gif" >' + message + '</h2>'});
};

var responseUI = function (message,color){
    $.unblockUI();
    $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: color,
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: 0.5,
        color: '#fff'
    }, message: '<h2>' + message + '</h2>'});
    setTimeout(function(){
        $.unblockUI();
    },750);
};

var ajaxForm = function (resource, type, data, form, method){
	var url= server + resource;
	var before = null;
	var error = null;
	var color = null;
	if(form === 'form') {
		before = "Registrando";
		error = "No se pueden grabar los datos.";
		color = "red";
	}
	if(type === 'delete' || (type === 'put' && method != 'restore')) {
		url += '/' + data.id;
	}
	if(method === 'restore') {
		url += '/restore/' + data.id;
	}
	return $.ajax({
			url: url,
		    type: type,
		    data: {data: JSON.stringify(data)},
		    datatype: 'json',
		    beforeSend: function(){
		    	if(before){
		    		loadingUI(before);	
		    	}else{
		    		console.log('Registrando');
		    	}
		    },
		    error:function(){
		        if(error){
		    		responseUI(error);	
		    	}else{
		    		console.log('No se pueden grabar los datos.');
		    	}
		    }
		});
};

var data = {};
var server = 'http://localhost/iglesiaQuepos/public/';

$(function(){

	$(document).on("click", "#btnDisabledTypeUser", function(e){
		e.preventDefault();
		var resource = $(this).data("resource");
		var id = $(this).parent().parent().find('.user_number').text();
		var name = $(this).parent().parent().find('.user_name').text();
		data.id = id;

		ajaxForm(resource, "delete", data, "form")
		.done(function(result){
			if(result == 1){
				window.location.href = server + 'type_users';
				responseUI("Se inhabilito el tipo de usuario "+name+" .", "green");
			}
			else {
				responseUI("No se pueden grabar los datos.", "red");
				console.log(result);
			}
		});
	});

	$(document).on("click", "#btnEnabledTypeUser", function(e){
		e.preventDefault();
		var resource = $(this).data("resource");
		var id = $(this).parent().parent().find('.user_number').text();
		var name = $(this).parent().parent().find('.user_name').text();
		data.id = id;

		ajaxForm(resource, "put", data, "form", "restore")
		.done(function(result){
			if(result == 1){
				window.location.href = server + 'type_users';
				responseUI("Se habilito el tipo de usuario "+name+" .", "green");
			}
			else {
				responseUI("No se pueden grabar los datos.", "red");
				console.log(result);	
			}
		});
	});

	$(document).on("click", "#editTypeUser", function(e){
		e.preventDefault();
		var id = $(this).parent().parent().find('.user_number').text();
		var state = $(this).parent().parent().find('.user_state').text().toLowerCase();
		var name = $(this).parent().parent().find('.user_name').text();
		if(state==='inactivo'){
			state = "0";
		}else{
			state = "1";
		}
		$("#id_typeUser").val(id);
		$("#name_typeUser").val(name);
		$("#slcState_typeUser").val(state);
		$('#modalEditTypeUser').modal();
	});

	$(document).on("click", "#btnUpdateTypeUser", function(e){
		e.preventDefault();
		var resource = $(this).data("resource");
		var message = null;
		data.id = $("#id_typeUser").val();;
		data.name = $("#name_typeUser").val();
		data.state = $("#slcState_typeUser").val();
		$("#btnLaddaEdit").show();		
		var l = Ladda.create(document.getElementById('btnLaddaEdit'));
		l.start();
		$("#msgEdit").html('');
		ajaxForm(resource, "put", data)
		.done(function(result){
			l.stop();
			$("#btnLaddaEdit").hide();
			if(result == 1){
				message = "<p class='color-green'><span class='glyphicon glyphicon-ok'></span> Se actualizaron los datos correctamente.</p>";
				$("#msgEdit").html(message);
				//window.location.href = server + 'type_users';
			}
			else {
				message = "<p class='color-red'><span class='glyphicon glyphicon-remove'></span> No se pueden grabar los datos.</p>";
				$("#msgEdit").html(message);
				console.log(result);
			}
		});
	});

	$(document).on("click", "#btnCreateTypeUser", function(e){
		e.preventDefault();
		var resource = $(this).data("resource");
		var message = null;
		data.name = $("#name_new_typeUser").val();
		data.state = $("#slcState_new_typeUser").val();
		$("#btnLaddaCreate").show();		
		var l = Ladda.create(document.getElementById('btnLaddaCreate'));
		l.start();
		$("#msgCreate").html('');
		ajaxForm(resource, "post", data)
		.done(function(result){
			l.stop();
			$("#btnLaddaCreate").hide();
			if(result == 1){
				message = "<p class='color-green'><span class='glyphicon glyphicon-ok'></span> Se registraron los datos correctamente.</p>";
				$("#msgCreate").html(message);
				//window.location.href = server + 'type_users';
			}
			else {
				message = "<p class='color-red'><span class='glyphicon glyphicon-remove'></span> No se pueden grabar los datos.</p>";
				$("#msgCreate").html(message);
				console.log(result);
			}
		});
	});

	$('#modalEditTypeUser').on('hidden.bs.modal', function (e) {
		$("#msgEdit").html('');
	});

});
