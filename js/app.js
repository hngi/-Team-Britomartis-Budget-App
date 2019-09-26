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

});