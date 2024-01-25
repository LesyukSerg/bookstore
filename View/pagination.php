<?php if (isset($nav) && $nav > 1): ?>
    <nav class="navbar fixed-bottom navbar-light bg-light mt-4">
        <ul class="pagination mx-auto">
            <?php
                $u = parse_url($_SERVER['REQUEST_URI']);
                $get = '&'.preg_replace("#&?page=\d+#",'', $u['query']);


                for ($p = 1; $p <= $nav; $p++) {
                    $params[] = "page=$p";

                    echo '<li class="page-item ' . ($page == $p ? 'active' : '') . '">
                            <a class="page-link" href="' . $u['path'] . '?page=' . $p . $get .'">' . $p . '</a>
                        </li>';
                }
            ?>
        </ul>
    </nav>
<?php endif;