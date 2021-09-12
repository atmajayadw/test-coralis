<div class="container col-lg-4">
    <div class="login mt-3">
        <h3>Change Password</h3>
        
        <form class="user" method="post" action="<?= base_url('auth/changePassword');?>">
            <div class="form-group">
                <label for="password1">Password </label>
                <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                <small class="form-text text-danger"><?= form_error('password1');?></small>
            </div>
                  
            <div class="form-group">
            <label for="password2">Confirm Password </label>
                <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Confirm Password">
            </div>

            <button type="submit" class="btn btn-primary btn-user btn-block">Change</button>
        </form>
        
        <hr/>
        <div class="text-center"> 
            <a class="small" href="<?= base_url('auth');?>">Login!</a>
        </div>  
        <div class="text-center"> 
            <a class="small" href="<?= base_url('auth/registration');?>">Create a new Account!</a>
        </div>
        
    </div>
</div>