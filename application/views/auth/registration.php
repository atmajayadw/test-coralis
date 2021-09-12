<div class="container col-lg-6">
    <div class="registration mt-3">
        <h3>Registration</h3>
            <form class="user" action="<?= base_url('auth/registration')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="name"
                    placeholder="Full Name" name="name" value="<?= set_value('name') ?>">
                    <small class="form-text text-danger"><?= form_error('name');?></small>

                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                    placeholder="Email Address" name="email" value="<?= set_value('email') ?>">
                    <small class="form-text text-danger"><?= form_error('email');?></small>

                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                        <small class="form-text text-danger"><?= form_error('password1');?></small>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user"
                        id="password2" name="password2" placeholder="Repeat Password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="hintQuestion">Hint Question </label>
                        <input type="text" class="form-control form-control-user" id="hintQuestion" name="hintQuestion" placeholder="Hint Question" value="<?= set_value('hintQuestion') ?>">
                        <small class="form-text text-danger"><?= form_error('hintQuestion');?></small>

                    </div>
                    <div class="col-sm-6">
                        <label for="hintAnswer">Hint Answer </label>
                        <input type="text" class="form-control form-control-user"
                        id="hintAnswer" name="hintAnswer" placeholder="Hint Answer" value="<?= set_value('hintAnswer') ?>">
                        <small class="form-text text-danger"><?= form_error('hintAnswer');?></small>

                    </div>
                </div>

                <div class="form-group">
                    <label for="profilePicture">Profile Picture : </label>
                    <input type="file" name="profilePicture" id="profilePicture">
                </div>
                                
                <button type="submit" class="btn btn-primary btn-user btn-block">Register Account </button>
                            
                <hr/>
                <div class="text-center"> 
                    <a class="small" href="<?= base_url('auth');?>">Already Have Accout</a>
                </div>  
            </form>
    </div>
</div>