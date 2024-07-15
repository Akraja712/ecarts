$('#validate_code_website','#validate_code_app').validate({
    rules: {
        purchase_code: "required"
    }
});
$('#result_success , #result_fail , #result_success_app , #result_fail_app').hide();

$('#validate_code_website').on('submit', async function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData);
    if ($("#validate_code_website").validate().form()) {
        var item_id = '33201609';
        
        var code = $('#purchase_code').val();
        var flag = validURL(domain_url);

        if (flag) {
            var response = await validator(code, domain_url, item_id, formData); // for app
            console.log(response);
            if (response.error) {
                alert("Invalid Domain URL");
            } else {
                $('#result_success').html(response.message);
                $('#result_success').show().delay(6000).fadeOut();
            }
        } else {
            alert("Something went  wrong");
        }
    }
});

$('#validate_code_app').on('submit', async function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData);
    if ($("#validate_code_app").validate().form()) {
        var item_id = '31977632';

        var code = $('#purchase_code_app').val();
        var flag = validURL(domain_url);

        if (flag) {
            var response = await validator_app(code, domain_url, item_id, formData); // for app
            console.log(response);
            if (response.error) {
                alert("Invalid Domain URL");
            } else {
                // console.log(response);
                $('#result_success_app').html(response.message);
                $('#result_success_app').show().delay(6000).fadeOut();
            }
        } else {
            alert("Something went  wrong");
        }
    }
});
var myURL;
// '^(https?:\\/\\/)?' + // protocol
function validURL(myURL) {
    var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + //port
        '(\\?[;&amp;a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$', 'i');
    return pattern.test(myURL);
}

async function validator(code, domain_url, item_id, formData) {
    let res;
    let response;
    await $.ajax({
        type: 'GET',
        url: 'https://wrteam.in/validator/home/validator_new?purchase_code=' + code + '&domain_url=' + domain_url + '&item_id=' + item_id,
        data: formData,
        beforeSend: function () {
            $('#btnValidate').html('Please wait..');
        },
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: async function (result) {
            console.log(result);
            if (!result.error) {
                $('#result_success').html(result.message);
                $('#result_success').show().delay(6000).fadeOut();
                $('#validate_code_website')[0].reset();
                response_data = "code_bravo=" + result.purchase_code;
                response_data += "&time_check=" + result.token;
                response_data += "&code_adam=" + result.username;
                response_data += "&dr_firestone=" + result.item_id;
                response_data += "&add_dr_silver=1";
                await $.ajax({
                    type: 'POST',
                    url: 'public/db-operation.php',
                    data: response_data,
                    beforeSend: function () {
                        $('#btnValidate').val('Please Wait..');
                    },
                    dataType: "json",
                    success: function (result) {
                        res = result;

                        if (result['error'] == false) {
                            $('#result_success').html(result.message);
                            $('#result_success').show().delay(6000).fadeOut();
                        } else {
                            $('#result_fail').html(result.message);
                            $('#result_fail').show().delay(6000).fadeOut();
                            $('#btnValidate').html('Validate Now');
                        }
                    }
                });
            } else {
                res = result;
                $('#result_fail').html(result.message);
                $('#result_fail').show().delay(6000).fadeOut();
            }
            $('#btnValidate').html('Validate Now');

        }
    });
    return res;

}


async function validator_app(code, domain_url, item_id, formData) {
    let res;
    let response;
    await $.ajax({
        type: 'GET',
        url: 'https://wrteam.in/validator/home/validator_new?purchase_code=' + code + '&domain_url=' + domain_url + '&item_id=' + item_id,
        data: formData,
        beforeSend: function () {
            $('#btnValidateApp').html('Please wait..');
        },
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: async function (result) {
            console.log(result);
            if (!result.error) {
                $('#result_success_app').html(result.message);
                $('#result_success_app').show().delay(6000).fadeOut();
                $('#validate_code_app')[0].reset();
                response_data = "code_bravo=" + result.purchase_code;
                response_data += "&time_check=" + result.token;
                response_data += "&code_adam=" + result.username;
                response_data += "&dr_firestone=" + result.item_id;
                response_data += "&add_dr_gold=1";
                await $.ajax({
                    type: 'POST',
                    url: 'public/db-operation.php',
                    data: response_data,
                    beforeSend: function () {
                        $('#btnValidateApp').val('Please Wait..');
                    },
                    dataType: "json",
                    success: function (result) {
                        res = result;

                        if (result['error'] == false) {
                            $('#result_success_app').html(result.message);
                            $('#result_success_app').show().delay(6000).fadeOut();
                        } else {
                            $('#result_fail_app').html(result.message);
                            $('#result_fail_app').show().delay(6000).fadeOut();
                            $('#btnValidateApp').html('Validate Now');
                        }
                    }
                });
            } else {
                res = result;
                $('#result_fail_app').html(result.message);
                $('#result_fail_app').show().delay(6000).fadeOut();
            }
            $('#btnValidateApp').html('Validate Now');

        }
    });
    return res;

}



