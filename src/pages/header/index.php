<link rel="stylesheet" href="../../style/styleHeader.css">
  <header class='nav'>
    <span>SEMEC</span>
    <nav>
        <div class="btnMenu">
            <div></div>
            <div class='btnMenuMeio'></div>
            <div></div>
        </div>
        <ul class='menu'>
            <li class='showName'>
                <?php echo strstr($_SESSION["name_person"]," ", true) . "..."; ?>
            </li>
            <li>
                <a href="../home">Página Inicial</a>
            </li>
            <li>
                <a href="../calendario">Calendários</a>
            </li>
            <li>
                <a href="../arquivo-passivo">Arquivo passivo</a>
            </li>
            <li>
                <a href="../transferencia">Transferencias</a>
            </li>
            <li>
                <a href="../escola">Escolas</a>
            </li>
            <li>
                <a href="../perfil">Perfil</a>
            </li>
            <li>
                <a href="../about">Sobre a semec</a>
            </li>
            <li>
                <a href="../../../">Sair</a>
            </li>
        </ul>
    </nav>
</header>