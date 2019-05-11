<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());


?><hr>
<pre>
P0
<?= var_dump($app->session->get("p0")) ?>
p1
<?= var_dump($app->session->get("p1")) ?>

Players
<?= var_dump($app->session->get("players")) ?>
</pre>
<hr>
