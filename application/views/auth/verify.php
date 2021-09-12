<div class="container col-lg-4">
    <div class="login mt-3">
        <h3>Verify</h3>

        <?php if ($this->session->flashdata('error')): ?>
            <?= $this->session->flashdata('error'); ?>
        <?php endif; ?> 
        
        <form class="user" method="post" action="<?= base_url('auth/verify');?>">
            <div class="form-group">
                <label for="hintQuestion">Hint Question </label>
                <input type="text" class="form-control form-control-user"
                id="hintQuestion" name="hintQuestion" placeholder="hintQuestion" value="<?= $this->session->userdata('hint_question'); ?>" disabled>
            </div>
                  
            <div class="form-group">
                <label for="hintAnswer">Hint Answer </label>
                <input type="text" class="form-control form-control-user"
                id="hintAnswer" name="hintAnswer" placeholder="hintAnswer">
                <small class="form-text text-danger"><?= form_error('hintAnswer');?></small>
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