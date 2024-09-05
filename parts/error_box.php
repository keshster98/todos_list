<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger" role="alert">
        <!-- Shows error message -->
        <?= $_SESSION['error']; ?>
        <?php
            // Remove error from $_SESSION after displaying it
            unset( $_SESSION['error'] );
        ?>
    </div>
<?php endif; ?>

