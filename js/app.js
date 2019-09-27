$(() => {
            
    $('#formReg').submit((e) => {
        e.preventDefault();
        let formData =  $('#formReg').serialize();
        
        $.ajax({
            type: 'POST',
            url: './phpInc/register.php',
            data: formData,
            success: function(result) {
                $('.repot').text(result);
            }
        })
    });

    $('#formlogin').submit((e) => {
        e.preventDefault();
        let formData =  $('#formlogin').serialize();
        
        $.ajax({
            type: 'POST',
            url: './phpInc/login.php',
            data: formData,
            success: function(result) {
                if (result) {
                    $('.repot').text(result);
                } else { 
                    location.replace('dashboard.php');
                }
    
            }
        })
    });

    $('#formreset').submit((e) => {
        e.preventDefault();
        let formData =  $('#formreset').serialize();
        
        $.ajax({
            type: 'POST',
            url: './phpInc/passwordreset.php',
            data: formData,
            success: function(result) {
                $('.repot').text(result);
            }
        })
    });

});