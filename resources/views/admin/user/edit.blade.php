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
                                <input class="form-control" name="username" id="username-edit" readonly />
                                </div>
                                <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="email-edit" readonly/>
                                </div>
                                 <fieldset class="form-group">
                                    <div class="row">
                                      <legend class="col-form-label col-sm-2 pt-0">Level</legend>
                                      <div class="col-sm-10 " >
                                        <div class="form-check">
                                          <input class="form-check-input leveledit" type="radio" name="level" id="gridRadios1" value="0">
                                          <label class="form-check-label" for="gridRadios1">
                                            Admin
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input leveledit" type="radio" name="level" id="gridRadios2" value="1">
                                          <label class="form-check-label" for="gridRadios2">
                                            User
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </fieldset>


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