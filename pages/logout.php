<?php
    // Remove user from the session
    unset( $_SESSION['user'] );
    // Redirect user back to home.php
    echo '<script>alert("Successfully logged out!");window.location.href="/"</script>';
    exit;
?>