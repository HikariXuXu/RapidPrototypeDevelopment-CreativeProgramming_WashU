<?php
    session_start();
    session_unset();
    ?>
    <script>
        document.getElementById("user").textContent = "";
    </script>
    <?php
    header('Location: Calendar.php');
?>