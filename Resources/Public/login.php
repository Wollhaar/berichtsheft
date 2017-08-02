<?php

require_once $_SERVER['DOCUMENT_ROOT'] .'/Resources/PHP/model/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Templates/mainTemplate.html';
?>


<div class="main">
    <div class="container"
        <form class="form-horizontal" role="form" method="post" action="<?php echo RP; ?>index.php?case=login">
            <div class="form-group">
                <?php if(!empty($_SESSION['access'])): ?>
                    <span class="wrong"><?php echo($_SESSION['access']); ?></span>
                <?php endif; ?>
                <input type="text" placeholder="Benutzer" class="form-control" name="username">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
        </form>
        <a href="<?php echo RP; ?>index.php?case=register" class="btn btn-link">Registrieren</a>

    </div>
</div>

</body>

</html>
