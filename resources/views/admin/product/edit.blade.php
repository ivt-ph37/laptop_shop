<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa <span class="tittle"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 5px">
                        <div class="col-lg-12">
                            <form action="" id="form-edit" method="POST" role="form">
                                @csrf
                        <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" id="name-edit" />
                                <div class="error1" style="color: red;"></div>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input class="form-control" name="quantity" id="quantity-edit"/>
                                <div class="error2" style="color: red;"></div>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" id="price-edit"/>
                                <div class="error3" style="color: red;"></div>
                            </div>
                            <div class="form-group">
                                <label>Supplier_Name</label>
                                <select class="form-group idSupplier" name="supplier_id" id="supplier_id-edit">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Category_Name</label>
                                <select class="form-group idCategory" name="category_id" id="category_id-edit">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>RAM</label>
                                <input class="form-control" name="RAM" id="ram-edit"/> 
                               
                            </div>
                            <div class="form-group">
                                <label>VGA</label>
                                <input class="form-control" name="VGA" id="vga-edit"/>
                            
                            </div>
                            <div class="form-group">
                                <label>Operating_System</label>
                                <input class="form-control" name="operating_system" id="operating_system-edit"/>
                          
                            </div>
                            <div class="form-group">
                                <label>CPU</label>
                                <input class="form-control" name="CPU" id="cpu-edit"/>
                                
                            </div>
                            <div class="form-group">
                                <label>Guarantee</label>
                                <input class="form-control" name="guarantee" id="guarantee-edit"/>
                       
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" rows="3" name="note" id="note-edit"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description" id="description-edit"></textarea>
                       
                            </div>
                            <div class="form-group">
                                <label>Sales_Volume</label>
                                <input class="form-control" name="sales_volume" id="sales_volume-edit"/>
                          
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                            <div class="idImage">
                                
                            </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>