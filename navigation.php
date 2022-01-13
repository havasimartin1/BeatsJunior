
    <nav>
        <div class="logo">
            <img src="/images/logo.png" width="60px">
        </div>
        <ul style="display: flex; align-items: center;">
            <li><a href="/">Home</a></li>
            <?php if(!isset($_COOKIE["sid"])): ?>
                <li><a onclick="showLoginModal()">Login</a></li>
            <?php endif; ?>
            <li><a onclick="showCartModal()"><img src="images/warenkorb.png" width="60"></a></li>
        </ul>

        
		<?php if(isset($_GET["fail"])): ?>
			<div onload="setTimeout(() => this.style.opacity = '0' ,1500)" style="pointer-events: none;position: fixed; z-index: 9; width: 100%; height: 100vh; background: rgba(0,0,0,0.85); padding: 18% 0; text-align: center; transition-duration: 800ms">Falsche Anmeldedaten
		<?php endif ?>
    </nav>