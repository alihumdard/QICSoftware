$(document).ready(function () {
    // alert('this is working');

    $(document).on('click', '#abc', function () {
        var id = $(this).attr('data-client_id');
        $.ajax({
            url: '/edit/' + id,
            method: 'GET',
            beforeSend: function () {
                $('#addclient').modal('show');
            },
            success: function (data) {
                data = JSON.parse(data);
                let formattedDateTime = moment(data[0].created_at).format("YYYY-MM-DDTHH:mm");
                $('#addclient #btn_save').html('save').css('background-color', '#233A85');
                $('#addclient #user_pic').val(data[0].user_pic);
                $('#addclient #client_id').val(data[0].id);
                $('#addclient #role').val(data[0].role);
                $('#addclient #name').val(data[0].name);
                $('#addclient #phone').val(data[0].phone);
                $('#addclient #email').val(data[0].email);
                $('#addclient #com_name').val(data[0].com_name);
                $('#addclient #address').val(data[0].address);
                $('#addclient #joining_date').val(formattedDateTime);
            }
        });
    });

    // modal form functions

    

    // modal form functions end

 
    












});

