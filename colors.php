<?php
    include 'functions.php';
    user_checks();
    
    include 'header.php'; 
    include 'menu.php';
    include 'clock.php';
?>
<html>
<h2>Choose a Color</h2>
<p>You cannot change your choice once you choose. Choose wisely.</p>
<p>The rules are written in the main page. Read it carefully before choosing.</p>
<p>You will get information on today's numbers upon choosing. Use that information wisely!</p>

<div class="red">
    <span class="text">
    <p><b><a href="red">Red</a></b></p>
</div>
<div class="green">
    <span class="text">
    <p><b><a href="green">Green</a></b></p>
</div>
<div class="blue">
    <span class="text">
    <p><b><a href="blue">Blue</a></b></p>
</div>
<div class="cyan">
    <span class="text">
    <p><b><a href="cyan">Cyan</a></b></p>
</div>
<div class="magenta">
    <span class="text">
    <p><b><a href="magenta">Magenta</a></b></p>
</div>
<div class="yellow">
    <span class="text">
    <p><b><a href="yellow">Yellow</a></b></p>
</div>
</html>