$(document).ready(function(){
			
    /* 
    ******************* 
        IMAGE UPLOAD 
    ******************
    */

    var id = 1;
    var _URL = window.URL || window.webkitURL;
    
    /* show add another image button when previous image uploaded */
    $('div.input-files').on('change', 'input:file', function (e) {

        var showId = ++id;
        var prevId = showId -1;
        // Gets the number of elements with class upimg
        var numItems = $('.upimg').length
        
        if(numItems <=5)
        {
            $("#file-up-btn-"+prevId).hide();
            $("#remove-"+prevId).show();
            $("#addAnother").show();            
        }

        /* image preview */
        var image, file;
        if ((file = this.files[0])) {
            image = new Image();
            image.onload = function() {
                src = this.src;
                $('#uploadPreview-'+prevId).html('<img src="'+ src +'"></div>');
                e.preventDefault();
            }
        };
        image.src = _URL.createObjectURL(file);
        /* .image preview */

        if(numItems == 5){
            $("#file-up-btn-"+numItems).hide();
            $("#remove-"+numItems).show();
            $("#addAnother").hide();
        }

    });

    $("#addAnother").on('click', '.addImg', function () {
        
        var showId = id;
        var prevId = showId -1;
        // Gets the number of elements with class upimg
        var numItems = $('.upimg').length

        $(".input-files").append('<div class="row upimg img-'+showId+'"><div class="col-lg-3"><div id="uploadPreview-'+showId+'" class="prev-img"></div></div><div class="col-lg-2"><label for="file-upload" class="custom-file-upload" id="file-up-btn-'+showId+'">Add a Photo</label><input type="file" name="file_upload[]"></div><a href="javascript:void(0);" id="remove-'+showId+'" class="remImg" style="display:none;"><i class="fa fa-minus-circle remove-num" aria-hidden="true"></i> Delete Image</a></div>');
        $("#addAnother").hide();
        
        if(numItems <=5)
        {
            $("#file-up-btn-"+prevId).hide();
            $("#remove-"+prevId).show();
        }
    });

    $(".input-files").on('click', '.remImg', function () {

        var showId = id;
        var prevId = showId -1;
        // Gets the number of elements with class upimg
        var numItems = $('.upimg').length

        if(numItems <=5)
        {
            $("#addAnother").show();   
        }
        $("#" + $(this).attr("id")).parent().remove();

    });
    
});