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
                                        <label>Name User</label>
                                        <select class="form-group idUser" name="user_id" id="user_id-edit">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name Product</label>
                                        <select class="form-group idProduct" name="product_id" id="product_id-edit">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label >Promotion</label>
                                        <input class="form-control" name="price" id="price-edit" />
                                        <div class="error1" style="color: red;"></div>
                                    </div>
                                    <div class="form-group">
                                        <label >Start Date</label>
                                        <input class="form-control" name="start_date" type="date" id="start_date-edit" />
                                    </div>
                                    <div class="form-group">
                                        <label >End Date</label>
                                        <input class="form-control" name="end_date" type="date" id="end_date-edit" />
                                        <div class="error34" style="color: red;"></div>
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