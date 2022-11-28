<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/')}}css/style.css">  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> 

  </head>
  <body>
    <div class="container">
        {{-- Heading --}}
        <div class="heading">
            <div class="title">
                <h2>Product List</h2>
            </div>
            <div class="add_btn"> 
                <button type="button" class="btn btn-primary" id="createNewProduct">
                    + Add Product
                  </button>
            </div>
        </div>
        {{-- Model --}}
        <div class="modal fade" id="productModal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="productLable"></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="productForm" method="post" enctype="multipart/form-data"> 
                    @csrf
                <div class="modal-body">
                    <div class="row">
                      <input type="hidden" name="product_id" id="product_id">
                        <div class="mb-3 col-lg-8">
                            <label for="product-name" class="form-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control" id="product-name" placeholder="Enter Product Name" required> 
                          </div>
                          
                          <div class="mb-3 col-lg-4">
                            <label for="product-number" class="form-label">Product No.</label>
                            <input type="text"  class="form-control" id="product-number" disabled> 
                            <input type="hidden" class="product-number" name="product_number">
                          </div>

                          <div class="mb-3 col-lg-12">
                            <label for="product-category" class="form-label">Category</label> 
                            <select class="form-select" id="product-category" name="product_category" required>
                                <option value="">Select Product category</option>
                                <option>Mobile Devices</option>
                                <option>Wearables</option>
                                <option>TVs, Set Top Boxes, Monitors</option>
                                <option>Laptops, Tablets, Computers</option>
                                <option>Appliances & White Goods</option>
                            </select>
                          </div>
                          <div class="mb-3 col-lg-6">
                            <label for="product-price" class="form-label"> Price</label>
                            <input type="text" name="product_price" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" maxlength="6" class="form-control" id="product-price" placeholder="Enter Product Price" required> 
                          </div>
                          <div class="mb-3 col-lg-6">
                            <label for="product-quantity" class="form-label"> Quantity</label>
                            <input type="text" name="product_quantity" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" maxlength="6" class="form-control" id="product-quantity" placeholder="Enter Product Quantity" required> 
                          </div>
                          <div class="mb-3 col-lg-12">  
                            <label for="product-description" class="form-label">Description</label>
                            <textarea class="form-control" placeholder="Enter Product Description" name="product_description" id="product-description" required></textarea> 
                          </div>
                          <div class="mb-3 col-lg-12">  
                            <label for="product-img" class="form-label" >Images</label>
                            <input type="file" class="form-control" name="product_img[]" id="product-img" required multiple > 
                            <div class="img-thumbs img-thumbs-hidden" id="img-preview"></div>
                          </div>
                    </div>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="submit_btn"></button>
                </div>
            </form>
              </div>
            </div>
          </div>
          {{-- End Model --}}
          <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 0; @endphp
                @foreach($product as $d)
                <tr>
                    <td>{{ ++$i }}</td> 
                    <td>{{$d->product_number}}</td> 
                    <td>{{$d->product_name}}</td> 
                    <td>{{$d->product_category}}</td> 
                    <td>{{$d->product_price}}</td> 
                    <td>{{$d->product_quantity}}</td> 
                    <td>{{$d->product_description}}</td> 
                    <td>
                        @foreach(json_decode($d->product_img) as $img)
                        <img class="product-img" src="{{ asset('product_img/' .   $img   ) }}"   alt="Product Image">
                        @endforeach
                    </td>   
                    <td>
                      <a href="#" onclick="edit_partner(this)" 
                        data-target="#productModal" 
                        data-toggle="modal" 
                        data-id="{{$d->id}}" 
                        data-product_number="{{$d->product_number}}" 
                        data-product_name="{{$d->product_name}}"  
                        data-product_category="{{$d->product_category}}"
                        data-product_price="{{$d->product_price}}"
                        data-product_quantity="{{$d->product_quantity}}"
                        data-product_description="{{$d->product_description}}"
                        data-product_img="{{$d->product_img}}"> 
                        <i class="fa fa-edit">Edit</i>
                      </a> 
                        <a href="/product-remove/{{$d->id}}{{$d->product_number}}" class="button deleteProduct"><i class="fa fa-trash">Delete</i></a></td>
                  </tr>
                @endforeach 
            </tbody> 
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
    <script src="/js/product.js"></script>
  </body>
</html>