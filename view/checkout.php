<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div>
    <?php
        if(empty($addresses)) {
            echo '<p>'.$this->translator->getText("Your addresses are never given. Please a new address.").'</p>';
        } else {
            echo '<p>'.$this->translator->getText("Please select an post address.").'</p>';
            echo '<input style="display: none" id="addressId" value="'.$addresses[0]->getId().'"></input>';
            echo '<select>';
            foreach ($addresses as $address){
                echo '<option onclick="_setAId('.$address->getId().')" id="address'.$address->getId().'">'
                    .$address->getFirstname().' '.$address->getLastname().'   '
                    .$address->getStreet().' '.$address->getZip().' '.$address->getCity().' Tel: '
                    .$address->getPhonenumber().'</option>';
            }
            echo '</select>';
        }
    ?>
    <button onclick="_addAddress()">Add a new address</button>
    <div id="add_address" style="display: none">
        <form action="index.php?action=checkout" method="post">
            <p><?php echo $this->translator->getText('Firstname').': '; ?></p>
            <input name="firstname"></input>
            <p><?php echo $this->translator->getText('Lastname').': '; ?></p>
            <input name="lastname"></input>
            <p><?php echo $this->translator->getText('Street').': '; ?></p>
            <input name="street"></input>
            <p><?php echo $this->translator->getText('Zip').': '; ?></p>
            <input name="zip"></input>
            <p><?php echo $this->translator->getText('City').': '; ?></p>
            <input name="city"></input>
            <p><?php echo $this->translator->getText('Tel.').': '; ?></p>
            <input name="phonenumber"></input>
            <p></p>
            <input type="submit" name="add_address" value="ADD">
        </form>
        <p><button onclick="_addAddressCancel()"><?php echo $this->translator->getText('CANCEL')?></p>
    </div>
    <?php
        include 'view/cart.php';
    ?>
    <p><button onclick="_sendOrder()"><?php echo $this->translator->getText('MAKE ORDER')?></p>

    <script>
        document.getElementById("top_table").style.display = "none";
        document.getElementById("checkout").style.display = "none";
        function _addAddress(){
            document.getElementById("add_address").style.display = "block";
        }
        function _addAddressCancel(){
            document.getElementById("add_address").style.display = "none";
        }
        function _setAId(id){
            document.getElementById("addressId").value = id;
        }
        function _sendOrder() {
            let addressId = document.getElementById("addressId").value
            $.ajax({
                type: 'POST',
                url: 'index.php?action=checkout',
                data: {
                    _makeOrder: true,
                    addressId: addressId
                },
                success: function (data) {
                    window.location.href = 'index.php?action=cart&ordered=true';
                    console.log(data);
                },
                error: function (data) {
                    $('#info_add').innerHTML = "error please try again";
                }
            });
        }

    </script>

</div>
