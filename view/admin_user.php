<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div>
    <?php
    include "admin.php";
    ?>
    <h3 id="alert"></h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Username</th>
            <th>E-Mail</th>
            <th>Function</th>
            <th>Password</th>
            <th>update</th>
        </tr>
        <?php
        $users = User::getUsers();
        foreach ($users as $users){
            $id = $users->getId();
            echo '<tr>';
            echo '<td>'.$id.'</td>';
            echo '<td><input id="firstname'.$id.'" type="firstname"/ value="'.$users->getFirstName().'"></td>';
            echo '<td><input id="lastname'.$id.'"  type="lastname"/ value="'.$users->getLastName().'"></td>';
            echo '<td>'.$users->getUsername().'</td>';
            echo '<td><input id="email'.$id.'"  style="min-width: 20em" type="email"/ value="'.$users->getEmail().'"></td>';
            echo '<td><input id="u_function'.$id.'"  type="function"/ value="'.$users->getFunction().'"></td>';
            echo '<td><input id="password'.$id.'"  type="password"/></td>';
            echo '<td><button onclick="_updateUserData('.$users->getId().')">'.$this->translator->getText("update data").'</button></td>';
            echo '</tr>';
        }
        ?>
    </table>
    <?php
    echo '<hr>';
    $href = '\'index.php?action=admin_user_add\'';
    echo '<button class="checkout" onclick="location.href='.$href.'">'.$this->translator->getText("Add a new user").'</button>';
    ?>
    <script>
        function _updateUserData(id) {
            const firstname = document.getElementById('firstname' + id).value;
            const lastname = document.getElementById('lastname' + id).value;
            const email = document.getElementById('email' + id).value;
            const u_function = document.getElementById('u_function' + id).value;
            const password = document.getElementById('password' + id).value;
            if (!password || !firstname || !lastname || !email || !u_function) {
                document.getElementById('alert').innerText = "Error:: not updated! Please enter all the values !!!";
                setInterval(function() {
                    document.getElementById('alert').innerText = "";
                }, 5000);
                return;
            }
            $.ajax({
                type: 'POST',
                url: 'index.php?action=admin_user',
                data: {
                    _updateUser: true,
                    id: id,
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    u_function: u_function,
                    password: password
                },
                success: function(data) {
                    window.location.reload();
                    console.log(data);
                },
                error: function(data) {
                    $('#info_add').innerHTML = "error please try again";
                }
            });
        }
    </script>
</div>