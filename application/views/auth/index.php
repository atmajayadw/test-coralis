<div class="container col-lg-4">
    <div class="login mt-3">
        <h3>Login</h3>
        <h2><?= $this->session->userdata('is_login'); ?></h2>

        <?php if ($this->session->flashdata('message')): ?>
            
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                
        <?php endif; ?> 

        <?php if ($this->session->flashdata('error')): ?>
            <div class="col-lg-4">
            <?= $this->session->flashdata('error'); ?>
            </div>

        <?php endif; ?> 

        
        <form class="user" method="post" action="<?= base_url('auth');?>">
            <div class="form-group">
                <input type="text" class="form-control form-control-user"
                id="email" name="email" placeholder="Email Address">
                <small class="form-text text-danger"><?= form_error('email');?></small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user"
                id="exampleInputPassword" name="password" placeholder="Password">
                <small class="form-text text-danger"><?= form_error('password');?></small>
            </div>
                                       
            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
        </form>
        
        <hr/>
        <div class="text-center">
            <a class="small" href="<?= base_url('auth/forgot');?>">Forgot Password?</a>
        </div>
        <div class="text-center"> 
            <a class="small" href="<?= base_url('auth/registration');?>">Create an Account!</a>
        </div>
        
    </div>
</div>