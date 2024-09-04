<?php
    // Start session for log out
    session_start();
    // Remove the user from the session
    unset( $_SESSION['user'] );
    // Redirect the user back to index.php
    echo '<script>alert("Successfully logged out!");window.location.href="index.php"</script>';
    exit;
?>