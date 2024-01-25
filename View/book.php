<?php
    use Classes\Utils;
    require view . 'header.php';
    require view . 'menu.php';
?>
<?= isset($updated) ? '<div class="alert alert-success" role="alert">Book has been updated</div>' : '' ?>
<?= isset($added) ? '<div class="alert alert-info" role="alert">Book has been added</div>' : '' ?>

<div class="container mt-5">
    <h2><?= $title ?></h2>

    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
        <div class="form-group">
            <label for="title"><code>*</code>Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="enter book title" value="<?= Utils::htmlEscape($book['title']) ?>" required>
        </div>
        <div class="form-group">
            <label for="name"><code>*</code>Published year:</label>
            <input type="text" class="form-control" id="published_year" name="published_year" placeholder="enter published year" value="<?= Utils::htmlEscape($book['published_year']) ?>" required>
        </div>

        <div class="form-group">
            <label for="author_id"><code>*</code>Author:</label>
            <select class="form-control" id="author_id" name="author_id[]" required multiple>
                <?php
                    foreach ($authors as $one) {
                        echo '<option value="' . $one['id'] . '" ' . (isset($book['authors'][$one['id']]) ? 'selected' : '') . ' >' . Utils::htmlEscape($one['name']) . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="genre_id"><code>*</code>Genre:</label>
            <select class="form-control" id="genre_id" name="genre_id" required>
                <?php
                    foreach ($genres as $one) {
                        echo '<option value="' . $one['id'] . '" ' . ($one['id'] == $book['genre_id'] ? 'selected' : '') . ' >' . Utils::htmlEscape($one['name']) . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="other_genre_id">Other genres:</label>
            <select class="form-control" id="other_genre_id" name="other_genre_id[]" multiple>
                <option></option>
                <?php
                    foreach ($genres as $one) {
                        echo '<option value="' . $one['id'] . '" ' . (isset($book['genres'][$one['id']]) ? 'selected' : '') . ' >' . Utils::htmlEscape($one['name']) . '</option>';
                    }
                ?>
            </select>
        </div>

        <button type="submit" class="btn mt-2 btn-primary float-end"><?= $id ? 'EDIT' : 'ADD' ?></button>
    </form>
</div>

<?php require view . 'footer.php' ?>
