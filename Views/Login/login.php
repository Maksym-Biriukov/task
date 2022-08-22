<div class="d-flex justify-content-center h-100 align-items-center">
    <form action="<?=url_encode($subdir, '/login');?>" method="post">
        <div class="form-floating ">
            <input type="text" name="login" class="form-control" id="floatingInput" placeholder="login">
            <label for="floatingInput">Login</label>
        </div>
        <br>
        <div class="form-floating ">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <br>        
        <input type="submit" id="enterence" name="login_form" value="Login in" class="btn btn-success">
    </form>
</div>