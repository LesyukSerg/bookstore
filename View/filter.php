<div class="card-deck pt-2">
    <div class="card px-4 py-3">
        <h4>Filter</h4>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group mt-2">
                <label for="yearFilter">Рік видання:</label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="years[]" id="year2022" value="2022">
                    <label class="custom-control-label" for="year2022">2022</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="year[]" id="year2021">
                    <label class="custom-control-label" for="year2021">2021</label>
                </div>
                <?php
                    foreach ($years as $one) {
                        echo '
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="years['.$one['id'].']" value="'.$one['id'].'" id="genre'.$one['id'].'"
                                '.(isset($selected['years'][$one['id']]) ? 'checked=checked' : '').'
                            >
                            <label class="custom-control-label" for="genre'.$one['id'].'">' . $one['name'] . '</label>
                        </div>';
                    }
                ?>
            </div>

            <div class="form-group mt-2">
                <h5>Genres:</h5>
                <?php
                    foreach ($genres as $one) {
                        echo '
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="genres['.$one['id'].']" value="'.$one['id'].'" id="genre'.$one['id'].'"
                                '.(isset($selected['genres'][$one['id']]) ? 'checked=checked' : '').'
                            >
                            <label class="custom-control-label" for="genre'.$one['id'].'">' . $one['name'] . '</label>
                        </div>';
                    }
                ?>
            </div>
            <div class="form-group mt-2">
                <h5>Authors:</h5>
                <?php
                    foreach ($authors as $one) {
                        echo '
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="authors['.$one['id'].']" value="'.$one['id'].'" id="author'.$one['id'].'"
                            '.(isset($selected['authors'][$one['id']]) ? 'checked=checked' : '').'
                            >
                            <label class="custom-control-label" for="author'.$one['id'].'">' . $one['name'] . '</label>
                        </div>';
                    }
                ?>
            </div>

            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
        </form>
    </div>
</div>