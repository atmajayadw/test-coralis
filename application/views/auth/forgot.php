<div class="container col-lg-4">
    <div class="login mt-3">
        <h3>Forgot Password</h3>

        <?php if ($this->session->flashdata('error')): ?>
            <?= $this->session->flashdata('error'); ?>
        <?php endif; ?> 
        
        <form class="user" method="post" action="<?= base_url('auth/forgot');?>">
            <div class="form-group">
                <input type="text" class="form-control form-control-user"
                id="email" name="email" placeholder="Email Address">
                <small class="form-text text-danger"><?= form_error('email');?></small>
            </div>
                                       
            <button type="submit" class="btn btn-primary btn-user btn-block">Submit</button>
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