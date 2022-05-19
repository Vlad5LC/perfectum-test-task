<section class="py-5">
    <div id="main_container" class="container px-4 px-lg-5 mt-5">
        <div class="user_messages"></div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($buylist as $key => $value) : ?>
                <?php foreach ($categr as $category) {
                    if ($category['id'] == $value['category_id']){
                        $thisCategory = $category['name'];
                    }
                }
                ?>
                <div class="col mb-5" id="<?= $value['id']; ?>">
                    <div class="card h-100 buylist">
                        <!-- Product details-->
                        <div title="<?= DELETE; ?>" class="delete_icon" data-id="<?= $value['id']; ?>"></div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $value['name']; ?></h5>
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <span class="text-muted text-decoration-line-through"><?= $value['creating_date']; ?></span>
                                <br>
                                <span class="text-muted text-decoration-line-through category_text"><?= CATEGORY_TITLE . ' : ' . $thisCategory; ?></span>
                                <div><?= $value['buylist']; ?></div>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" data-id="<?= $value['id']; ?>" id="save-info<?= $key; ?>" <?php if ($value['bought']) : ?> checked <?php endif; ?> >
                                <label class="custom-control-label" for="save-info<?= $key; ?>"><?= SORT_BOUGHT ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"  id="exampleModalBody">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= NEW_LIST; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"><?= LIST_NAME; ?></label>
                        <input type="text" class="form-control" id="recipient-name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label"><?= LIST_TEXT; ?></label>
                        <textarea class="form-control" id="message-text" name="buylist"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label"><?= CATEGORY_TITLE; ?></label>
                        <select class="custom-select" id="category_id" name="category_id">
                            <option selected=""><?= SELECT_CATEGORY; ?></option>
                            <?php foreach ($categr as $category) : ?>
                                <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= CANCEL_TEXT; ?></button>
                <button type="button" class="btn btn-primary" id="list_add"><?= ADD_LIST; ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel"><?= ADD_CATEGORY; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"><?= CATEGORY_NAME; ?></label>
                        <input type="text" class="form-control" id="сategory_name" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= CANCEL_TEXT; ?></button>
                <button type="button" class="btn btn-primary" id="сategory_add"><?= ADD_LIST; ?></button>
            </div>
        </div>
    </div>
</div>
<div class="loader">
    <div class="lds-roller">
        <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
    </div>
</div>
<script type='text/javascript'>
    $(document).ready(function(){

        $(document).on('click', '.custom-control-input', function () {
            $('.loader').addClass('start');
            let isChecked = $(this).prop('checked');
            let checked = 0;

            if (isChecked === true){
                checked = 1;
            }
            else {
                checked = 0;
            }
            $.ajax({
                url: '<?=base_url()?>Buylist/listsDetail/',
                type: "post",
                data: {
                    'bought': checked,
                    'id': $(this).data('id')
                },
                dataType: "json",
                crossDomain: true,
                //timeout: 15000,
                success: function (response) {
                    $('.loader').removeClass('start');
                }
            });

        });

        $(document).on('click', '#list_add', function () {
            $('.loader').addClass('start');

            var $data = {};

            $('#myForm').find ('input, textarea, select').each(function() {
                $data[this.name] = $(this).val();
            });

            $.ajax({
                url: '<?=base_url()?>Buylist/addNewList/',
                type: "post",
                data: {
                    'name': $data.name,
                    'buylist': $data.buylist,
                    'category_id': $data.category_id
                },
                dataType: "json",
                crossDomain: true,
                success: function (response) {
                    $(".py-5").load("index.php #main_container");
                    $("#exampleModal").modal('hide');
                    setTimeout(function() {
                        $(".user_messages").text('Новий список успішно додано');
                        $(".user_messages").show();
                    }, 300);
                    $('.loader').removeClass('start');
                },
                error: function() {
                    $('.loader').removeClass('start');
                    alert("Перевірте поля на правильність заповнення");
                }
            });
            return false;
        });
        $(document).on('click', '#сategory_add', function () {
            $('.loader').addClass('start');
            var $data = {};

            $('#categoryForm').find ('input').each(function() {
                $data[this.name] = $(this).val();

                $.ajax({
                    url: '<?=base_url()?>Buylist/addCategory/',
                    type: "post",
                    data: {
                        'name': $data.name,
                    },
                    dataType: "json",
                    crossDomain: true,
                    success: function (response) {
                        $(".py-5").load("index.php #main_container");
                        $("#exampleModal").load("index.php #exampleModalBody");
                        $("#adding_category").load("index.php #js-category");
                        $("#categoryModal").modal('hide');
                        setTimeout(function() {
                            $(".user_messages").text('Категорію додано успішно');
                            $(".user_messages").show();
                        }, 300);
                        $('.loader').removeClass('start');
                    },
                    error: function() {
                        $('.loader').removeClass('start');
                        alert("Перевірте правильність заповнення полів");
                    }
                });

            });
        });


        $(document).on('click', '.delete_icon', function () {
            let deleteId = $(this).data('id');
            $('.loader').addClass('start');

            $.ajax({
                url: '<?=base_url()?>Buylist/deleteList/',
                type: "post",
                data: {
                    'id': $(this).data('id')
                },
                dataType: "json",
                crossDomain: true,
                success: function (response) {
                    $(".py-5").load("index.php #main_container");
                    $('.loader').removeClass('start');
                    setTimeout(function() {
                        $(".user_messages").text('Список успішно видалено');
                        $(".user_messages").show();
                    }, 300);

                }
            });
            return false;
        });

        $(document).on('change', '#js-sort', function () {
            $('.loader').addClass('start');
            $.ajax({
                url: '<?=base_url()?>Buylist/indexNew/',
                type: "post",
                data: {
                    'bought': $(this).val()
                },
                dataType: "json",
                crossDomain: true,
                success: function (response) {
                    var htmlReady = response;
                    $('.justify-content-center').html(htmlReady);
                    $('.loader').removeClass('start');
                }
            });
            return false;
        });

        $(document).on('change', '#js-category', function () {
            $('.loader').addClass('start');
            $.ajax({
                url: '<?=base_url()?>Buylist/categoryNew/',
                type: "post",
                data: {
                    'category_id': $(this).val()
                },
                dataType: "json",
                crossDomain: true,
                success: function (response) {
                    var htmlReady = response;
                    $('.justify-content-center').show();
                    $(".user_messages").hide();
                    $('.justify-content-center').html(htmlReady);
                    $('.loader').removeClass('start');
                    if (htmlReady == null){
                        $('.justify-content-center').hide();
                        $(".user_messages").text('Категорій не знайдено');
                        $(".user_messages").show()
                    }
                },
                error: function() {
                    $('.justify-content-center').hide();
                    $(".user_messages").text('Категорій не знайдено');
                    $(".user_messages").show();
                    $('.loader').removeClass('start');
                    console.log('error');
                }
            });
            return false;
        });

    });
</script>


