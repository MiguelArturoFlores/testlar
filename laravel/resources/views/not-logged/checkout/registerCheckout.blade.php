<h2>1 Direccion del envio<h2/>

    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="{{$user->name}}"/></td>
        </tr>

        <tr>
            <td>last name</td>
            <td><input type="text" name="lastname" value="{{$user->lastname}}"/></td>
        </tr>

        <tr>
            <td>address</td>
            <td><input type="text" name="address" value="{{$user->address}}"/></td>
        </tr>

        <tr>
            <td>cellphone</td>
            <td><input type="text" name="cellphone" value="{{$user->cellphone}}"/></td>
        </tr>

        <tr>
            <td>Country</td>
            <td><input type="text" name="country" value="Colombia" readonly/></td>
        </tr>

        <tr>
            <td>State</td>
            <td>{{Form::select('state',$stateList,$statePosition)}}</td>
        </tr>

        <tr>
            <td>email</td>
            <td><input type="text" name="email" value="{{$user->email}}"/></td>
        </tr>

    </table>