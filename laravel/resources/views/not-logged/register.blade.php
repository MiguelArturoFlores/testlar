<h3>Register</h3>
<br/>
<form action="/user/register" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name"/></td>
        </tr>

        <tr>
            <td>last name</td>
            <td><input type="text" name="lastname"/></td>
        </tr>

        <tr>
            <td>address</td>
            <td><input type="text" name="address"/></td>
        </tr>

        <tr>
            <td>cellphone</td>
            <td><input type="text" name="cellphone"/></td>
        </tr>

        <tr>
            <td>Country</td>
            <td><input type="text" name="country" value="Colombia" readonly/></td>
        </tr>

        <tr>
            <td>State</td>
            <td>{{Form::select('state',$stateList)}}</td>
        </tr>

        <tr>
            <td>email</td>
            <td><input type="text" name="email"/></td>
        </tr>

        <tr>
            <td>Password</td>
            <td><input type="password" name="password"/></td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Register"/>
            </td>
        </tr>
    </table>

</form>