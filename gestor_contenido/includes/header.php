<header>
<div class="navbar">
            <h1>EcuadorProtege</h1>
        <button class="menu-button" onclick="toggleMenu()">☰</button>
        <div class="nav-items-right">
            
        <ul class="navbar-nav">
        <div id="search-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <input type="text" id="search-input" placeholder="Buscar...">
        <button id="search-btn">Buscar</button>
    </div>
</div>
            <li class="nav-item"><p><?php echo $_SESSION['username']; ?></p></li>
            <!--li class="nav-item"><p>Rol: <!-?php echo htmlspecialchars($rol); ?></p></li-->
            <li class="nav-item"><a href="../logout.php" class="nav-link">Cerrar Sesión</a></li>
            <li class="nav-item"><a href="#" id="search-icon"><i class="fas fa-search"></i></a></li>
            
        </ul>
        </div>
        
</div>


<link rel="stylesheet" href="../css/button.css">
</header>