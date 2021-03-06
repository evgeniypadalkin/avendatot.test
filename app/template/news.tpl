<html>
    <head>
        <meta charset="utf-8">

        <title>Avendator Test</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="/public/js/jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <header></header>

        <div class="container">
            <div class="row justify-content-end">
                <div class="col-3">
                    <button onclick="addItem()" type="button" class="btn btn-success">Add</button>
                </div>
            </div>
        </div>

        <div class="container news-container">
            <?php foreach($news as $item){ ?>
                <div class="row row-<?php echo $item['id'] ?> news-row">
                    <div class="col-3 title">
                        <?php echo $item['title'] ?>
                    </div>
                    <div class="col-6 text">
                        <?php echo $item['text'] ?>
                    </div>
                    <div class="col-3">
                        <button onclick="editItem(<?php echo $item['id'] ?>)" type="button" class="btn btn-outline-primary">Edit</button>
                        <button onclick="deleteItem(<?php echo $item['id'] ?>)" type="button" class="btn btn-outline-danger">Delete</button>
                    </div>
                </div>
            <?php } ?>
            <div class="paginate"> <?php echo $paginate ?> </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit news</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/news/edit" id="news">
                            <div class="form-group">
                                <input name="title" type="text" value="" class="form-control" placeholder="Title*">
                                <textarea name="text" class="form-control" placeholder="Text*"></textarea>
                                <input type="hidden" value="" name="item_id">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="news" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="/public/js/common/news.js"></script>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    </body>
</html>
