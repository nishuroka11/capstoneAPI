<script>
    // Add the following code if you want the name of the file appear on select
    $(".image-upload").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        let $_previous_image_url = $(this).siblings(".previous-image-url");
        let formData = new FormData();
        let $_img_placeholder = $(this).siblings('.img-placeholder');
        let $_current_image = $(this).siblings('.current_image');
        formData.append('fileImage', $(this)[0].files[0]);
        formData.append('folderName', $(this).data('folder-name'));
        $.ajax({
            type: 'POST',
            url: '{{route('backend.ajax.uploads.image-upload')}}',
            data: formData,
            processData: false,
            contentType: false,
            enctype: "multipart/form-data",
            beforeSend: function () {
                $('#gif-loading-screen').show();
            },
        }).then(function (data, textStatus, jqXHR) {
            $('#gif-loading-screen').hide();
            try{
                if(data.status){
                    $_previous_image_url.val(data.data.imagePath);
                    console.log(data.data.imagePath);
                    $_current_image.val(data.data.imagePath);
                    $_img_placeholder.attr('src', data.data.assetImagePath);
                }else{
                    toastr.error(data.message);
                }
            }catch (e) {
                console.log(e);
            }
        }, function (jqXHR, textStatus, errorThrown) {
            $('#gif-loading-screen').hide();
            toastr.error(errorThrown);
        });

    });
</script>
