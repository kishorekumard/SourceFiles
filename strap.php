<!DOCTYPE html>
<html lang="en">
<head>
<title>Example of Bootstrap 3 Nested Columns</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style type="text/css">
    /* Some custom styles to beautify this example */
    .demo-content{
        padding: 15px;
        font-size: 18px;
        min-height: 100px;
        background: #dbdfe5;
    }
    .col-wrapper{
        background: #abb1b8;
    }
</style>
</head>
<body>
    <!-- Open the output in a new blank tab (Click the arrow next to "Show Output" button) and resize the browser window to understand how the Bootstrap responsive grid system works. -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-wrapper">
                <h2>Nested row within a column</h2>
                <div class="row">
                    <div class="col-xs-4 col-sm-6">
                        <div class="demo-content">.col-xs-4 .col-sm-6</div>
                    </div>
                    <div class="col-xs-8 col-sm-6">
                        <div class="demo-content">.col-xs-8 .col-sm-6</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>                                                                                