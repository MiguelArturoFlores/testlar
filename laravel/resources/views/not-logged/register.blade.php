<div class="registerHeaderDiv">
    Register
    <br/>
    <br/>

    <form action="/user/register" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

        <div class="registerInputLabelDiv">
            Nombre
        </div>

        <div class="registerInputDiv">
            <input type="text" name="name"/>
        </div>

        <div class="registerInputLabelDiv">
            Apellido
        </div>

        <div class="registerInputDiv">
            <input type="text" name="lastname"/>
        </div>

        <div class="registerInputLabelDiv">
            Direccion
        </div>

        <div class="registerInputDiv">
            <input type="text" name="address"/>
        </div>
        <div class="registerInputLabelDiv">
            Telefono
        </div>
        <div class="registerInputDiv">
            <input type="text" name="cellphone"/>
        </div>
        <div class="registerInputLabelDiv">
            Pais
        </div>
        <div class="registerInputDiv">
            <input type="text" name="country" value="Colombia" readonly/>
        </div>
        <div class="registerInputLabelDiv">
            Ciudad
        </div>
        <div class="registerInputLabelDiv ">
            {{Form::select('state',$stateList)}}
        </div>
        <br/>
        <div class="registerInputLabelDiv">
            Email
        </div>
        <div class="registerInputDiv">
            <input type="text" name="email"/>
        </div>
        <div class="registerInputLabelDiv">
            Contrasena
        </div>
        <div class="registerInputDiv">
            <input type="password" name="password"/>
        </div>
        <div class="registerInputDiv">
            <input type="submit" value="Registrarme"/>
        </div>

    </form>
</div>