<div class="mb-3">
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="get">
        <input hidden name="page" value="<?=$_GET['page']??1?>" >
        <div class="form-row">
            <div class="d-flex justify-content-end">
            <div class="m-2">
                <strong>Sort by:</strong>
            </div>

            <div>
                <select class="form-control" id="type" name="type" onchange="this.form.submit()">
                    <option value="name" <?= ($_GET['type'] == 'name' ? 'selected' : '') ?> >Title</option>
                    <option value="year" <?= ($_GET['type'] == 'year' ? 'selected' : '') ?> >Year</option>
                </select>
            </div>
            <div>
                <select class="form-control" id="order" name="order" onchange="this.form.submit()">
                    <option value="asc" <?= ($_GET['order'] == 'asc' ? 'selected' : '') ?> >A-Z</option>
                    <option value="desc" <?= ($_GET['order'] == 'desc' ? 'selected' : '') ?> >Z-A</option>
                </select>
            </div>
        </div>
    </form>
</div>