<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loggin App</title>

    <link type="text/css" rel="stylesheet" href="<?= base_url; ?>assets/css/normalize.css" />
    <link type="text/css" rel="stylesheet" href="<?= base_url; ?>assets/css/jquery.datetimepicker.min.css" />
    <link type="text/css" rel="stylesheet" href="<?= base_url; ?>assets/css/style.css" />
</head>
<body>

    <div class="container">

        <div class="coll">
            <h2>Time log app</h2>
        </div>

        <div class="content">
            <div class="content-list panel">

            </div>
        </div>

        <div class="navbar">
            <div class="panel">
                <form id="add_log">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" required ></textarea>
                    </div>

                    <div class="form-group">
                        <label>Time spent</label>
                        <input class="form-control datetimepicker" type="text" name="time" required />
                    </div>

                    <div class="coll">
                        <input class="btn btn-default" type="submit" value="Add" />
                    </div>
                </form>
            </div>

        </div>

    </div>
    <script>
        var base_url = '<?= base_url ?>';
    </script>
    <script src="<?= base_url; ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url; ?>assets/js/moment.js"></script>
    <script src="<?= base_url; ?>assets/js/jquery.datetimepicker.full.min.js"></script>
    <script src="<?= base_url; ?>assets/js/app.js"></script>

</body>
</html>