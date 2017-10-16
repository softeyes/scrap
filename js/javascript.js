console.log('loaded');

$(document).ready(setup);

function setup() {
	console.log('Inside setup');
	check_backend();
}

function check_backend() {
    console.log('Inside check_backend');
    $.get('backend/common/check.php')
    .done(success)
    .fail(fail);
}

function success(data){
	console.log(data);
}

function fail(data) {
	console.log('oops...');
	console.log(data);
}
