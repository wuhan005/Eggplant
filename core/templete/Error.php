<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .ep-body{
            background: #fff;
            color: #666;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px 30px;
            position: relative;
            box-sizing: border-box;
            transition: box-shadow .1s ease-in-out;
        }

        .ep-title {
            color: #9C27B0;
            font-size: 24px;
            line-height: 1.4;
        }

        .ep-footer {
            padding: 15px 30px;
            text-align: right;
            color: #8590a6;
        }

        .ep-container {
            box-sizing: content-box;
            max-width: 1380px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 15px;
            padding-right: 15px
        }

        @media (min-width: 640px) {
            .ep-container {
                padding-left:30px;
                padding-right: 30px
            }
        }

        @media (min-width: 960px) {
            .ep-container {
                padding-left:40px;
                padding-right: 40px
            }
        }
    </style>
</head>
<body>
    <div class="ep-container ep-body">
        <h3 class="ep-title">Oh no! An error occured.</h3>
        <p><h4><?php echo($errorMsg);?></h4></p>
        <div class="ep-footer"><b><?php echo(EP_FOOTER);?></b> | <?php echo(EP_VERSION);?></div>
    </div>
</body>
</html>