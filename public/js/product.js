$(document).ready(function () {
    // ---Data-Table---
    $('#example').DataTable();

    //--new product---
    $('#createNewProduct').click(function () { 
        $(".alert").hide()
        $(".wrapper-thumb .img-preview-thumb , .wrapper-thumb .product-img , .wrapper-thumb .remove-btn").remove(); 
        $(".form-control , .form-select").val('')   
      $('#productModal').modal('show'); 
        $("#productLable").html('Add Product');
        $("#productForm").attr('action', '/product-add');
        $("#submit_btn").html("Save")
        $(".form-control").val('')
    });
    //---random-product-name--
    $("#product-name").on("change", function(){
        var value = $(this).val();
        var ram = Math.random().toFixed(2) * 100;
        var newValue = value.substring(0, 3);
        $('#product-number').val(newValue + ram );
        $('.product-number').val(newValue + ram );
    })
    //--img-preview---
    
    var imgUpload = document.getElementById('product-img'),
        imgPreview = document.getElementById('img-preview')
        , imgUploadForm = document.getElementById('form-upload')
        , totalFiles
        , previewTitle
        , previewTitleText
        , img;
        
        imgUpload.addEventListener('change', previewImgs, true);

        function previewImgs(event) {
        totalFiles = imgUpload.files.length;  
            if(!!totalFiles) {
            imgPreview.classList.remove('img-thumbs-hidden');
            
        }
        
        for(var i = 0; i < totalFiles; i++) { 
            wrapper = document.createElement('div');
            wrapper.classList.add('wrapper-thumb');
            removeBtn = document.createElement("span");
            nodeRemove= document.createTextNode('x');
            removeBtn.classList.add('remove-btn');
            removeBtn.appendChild(nodeRemove);
            img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.classList.add('img-preview-thumb');
            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            imgPreview.appendChild(wrapper);
            //--img-remove
            $('.remove-btn').click(function(){
            $(this).parent('.wrapper-thumb').remove();
            });  
        }  
    } 
});
  

    //---delete-product---
    $('.deleteProduct').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
        });
    });
    
 
 
   
  