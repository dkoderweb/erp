$(document).ready(function () {
    // ---Data-Table---
    $('#example').DataTable();

    //--new product---
    $('#createNewProduct').click(function () { 
      $('#productModal').modal('show'); 
        $("#productLable").html('Add Product');
        $("#productForm").attr('action', '/product-add');
        $("#submit_btn").html("Save")
        $(".form-control").val('')
        $(".img-preview").remove();  
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
    //---edit-modal---
    function edit_partner(el) {
        $('#productModal').modal('show');
        $("#productLable").html('Update Product');
        $("#productForm").attr('action', '/product-update');
        $("#submit_btn").html("Update")
        $("#img-preview").show()
            var link = $(el) //refer `a` tag which is clicked
            var modal = $("#productModal").show() //your modal
            var product_id = link.data('id')
            var product_name = link.data('product_name') 
            var product_number = link.data('product_number') 
            var product_category = link.data('product_category') 
            var product_price = link.data('product_price') 
            var product_quantity = link.data('product_quantity') 
            var product_description = link.data('product_description') 
            var product_img = link.data('product_img') 

            modal.find('#product_id').val(product_id); 
            modal.find('#product-name').val(product_name);  
            modal.find('#product-number').val(product_number);  
            modal.find('.product-number').val(product_number);  
            modal.find('#product-category').val(product_category);  
            modal.find('#product-price').val(product_price);  
            modal.find('#product-quantity').val(product_quantity);  
            modal.find('#product-description').val(product_description);  
                                 
            var db = JSON.stringify(product_img);
            var jsonResults = JSON.parse(db); 

            for(i = 0; i < jsonResults.length; i++) {
                $('#img-preview').append('<img src="product_img/'+ jsonResults[i]+'" class="img-preview">'); 
             }

            $("#product-img").on("change", function(){
                $(".img-preview").remove();
            });
    }

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
   
  
