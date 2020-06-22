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
                                <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" id="username-edit" readonly/>
                                <div class="error6" style="color: red;"></div>
                                </div>
                                <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" id="email-edit" readonly/>
                                <div class="error6" style="color: red;"></div>
                                </div>
                                <div class="form-group">
                                <label>Deliver_Status</label>
                                <select class="form-group" name="deliver_status" id="deliver_status-edit">
                                    <option value="0" id="option0">Chờ xử lý</option>
                                    <option value="1" id="option1">Đang giao hàng</option>
                                    <option value="2" id="option2">Hoàn thành</option>
                                </select>
                            </div>
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