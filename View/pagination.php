<?php if (isset($nav) && $nav > 1): ?>
    <nav class="navbar fixed-bottom navbar-light bg-light">
        <ul class="pagination mx-auto">
            <?php
                for ($p = 1; $p <= $nav; $p++) {
                    echo '<li class="page-item ' . ($page == $p ? 'active' : '') . '">
                            <a class="page-link" href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . $p . '">' . $p . '</a>
                        </li>';
                }
            ?>
        </ul>
    </nav>
<?php endif;