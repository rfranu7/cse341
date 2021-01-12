<nav>
    <ul>
        <li <?php if($page == "home"){ echo 'class="active"'; } ?>><a href="./">Home</a></li>
        <li <?php if($page == "profile"){ echo 'class="active"'; } ?>><a href="./?action=profile">My Profile</a></li>
        <li <?php if($page == "work"){ echo 'class="active"'; } ?>><a href="./?action=work">My Work</a></li>
    </ul>
</nav>