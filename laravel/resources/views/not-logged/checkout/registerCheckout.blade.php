<div class="checkoutRegisterInfoDiv ">
    <div class="checkoutBuyProcessHeaderNumber">
        1.
    </div>
    <div class="checkoutBuyProcessHeaderText">
        Datos
    </div>
    <br/><br/>

    <div class="checkoutRegisterInputLabelDiv">
        Nombre*
    </div>
    <div class="checkoutRegisterInputDiv">
        <input type="text" name="name" value="{{$user->name}}"/>
    </div>

    <div class="checkoutRegisterInputLabelDiv">
        Apellido*
    </div>
    <div class="checkoutRegisterInputDiv">
        <input type="text" name="name" value="{{$user->lastname}}"/>
    </div>

    <div class="checkoutRegisterInputLabelDiv">
        Email*
    </div>
    <div class="checkoutRegisterInputDiv">
        <input type="text" name="name" value="{{$user->email}}"/>
    </div>

    <div class="checkoutRegisterInputLabelDiv">
        Pais*
    </div>
    <div class="checkoutRegisterInputDiv">
        <input type="text" name="country" value="Colombia" readonly/>
    </div>

    <div class="checkoutRegisterInputLabelDiv">
        Ciudad*
    </div>
    <div class="checkoutRegisterInputDiv">
        {{Form::select('state',$stateList,$statePosition)}}
    </div>

    <div class="checkoutRegisterInputLabelDiv">
        Direccion*
    </div>
    <div class="checkoutRegisterInputDiv">
        <input type="text" name="name" value="{{$user->address}}"/>
    </div>

    <div class="checkoutRegisterInputLabelDiv">
        Telefono
    </div>
    <div class="checkoutRegisterInputDiv">
        <input type="text" name="name" value="{{$user->cellphone}}"/>
    </div>

</div>
<div class="checkoutSeparatorDiv w3-card-2">

</div>