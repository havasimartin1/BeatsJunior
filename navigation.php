
    <nav>
        <div class="logo">
            <img src="images/logo.png" width="60px">
        </div>
        <ul style="display: flex; align-items: center;">
            <li><a href="./">Home</a></li>
            <?php if(!isset($_COOKIE["sid"])): ?>
                <li><a onclick="showLoginModal()">Login</a></li>
            <?php endif; ?>
            <li><a onclick="showCartModal()"><img src="images/warenkorb.png" width="60"></a></li>
        </ul>
    </nav>