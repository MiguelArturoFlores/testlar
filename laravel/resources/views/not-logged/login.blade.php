<div class="loginHeaderDiv">
    Login
    <br/>
    <br/>

    <form action="/login" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

        <div class="loginInputLabelDiv">
            Email
        </div>

        <div class="loginInputDiv">
            <input type="text" name="email"/>
        </div>

        <div class="loginInputLabelDiv">
            Password
        </div>

        <div class="loginInputDiv">
            <input type="password" name="password"/>
        </div>

        <div class="loginInputDiv">
            <input type="submit" value="Login"/>
        </div>
    </form>

</div>
<div class="loginSeparatorDiv">
</div>