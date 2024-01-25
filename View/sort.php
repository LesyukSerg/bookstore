<div class="mt-3 mb-2">
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="get">
        <input hidden name="page" value="<?=$_GET['page']?>" >
        <div class="form-row">
            <div class="form-group col-md-6 text-right">
                <strong>Sort by:</strong>
            </div>
            <select class="form-control col-md-6 float-end" id="type" name="type" onchange="this.form.submit()">
                <option value="name" <?= ($_GET['type'] == 'name' ? 'selected' : '') ?> >Title</option>
                <option value="year" <?= ($_GET['type'] == 'year' ? 'selected' : '') ?> >Year</option>
            </select>
            <select class="form-control col-md-6 float-end" id="order" name="order" onchange="this.form.submit()">
                <option value="asc" <?= ($_GET['order'] == 'asc' ? 'selected' : '') ?> >A-Z</option>
                <option value="desc" <?= ($_GET['order'] == 'desc' ? 'selected' : '') ?> >Z-A</option>
            </select>
        </div>
    </form>
</div>