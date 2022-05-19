<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>js/script.js"></script>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?= base_url(); ?>buylist/"><?= BUY_LIST ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="btn btn-outline-dark" id="add_list" type="submit" data-toggle="modal" data-target="#exampleModal">
                    <i class="bi-cart-fill me-1"></i>
                    <?= ADD_LISTS; ?>
                </button>
                <button class="btn btn-outline-dark" id="add_category" type="submit" data-toggle="modal" data-target="#categoryModal">
                    <i class="bi-cart-fill me-1"></i>
                    <?= ADD_CATEGORY; ?>
                </button>
            </div>
        </div>
        <form>
            <div class="select-sort">
                <select class="custom-select" name="sort" id="js-sort">
                    <option value="" selected><?= SORT_UA; ?></option>
                    <option value="0"><?= SORT_NOT_BOUGHT; ?></option>
                    <option value="1"><?= SORT_BOUGHT; ?></option>
                </select>
            </div>
        </form>
        <form>
            <div class="select-sort" id="adding_category">
                <select class="custom-select" name="sort" id="js-category">
                        <option value="#" selected><?= SELECT_CATEGORY; ?></option>
                    <?php foreach ($categr as $category) : ?>
                        <option value="<?= $category['id'];?>"><?= $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </nav>
</head>
<body>