<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error occurred in Eggplant</title>
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

        .ep-subtitle{
            display: block;
            margin-block-start: 10px;
            margin-block-end: 10px;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .ep-path{
            color: #989898;
            font-size: 10px;
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

        .ep-code-index{
            width: 10px;
            text-align: right;
        }

        .ep-error-line{
            background-color: #ffe5ed;
        }

        .ep-list {
            margin-top: 0px;
            padding: 0;
            list-style: none;
        }

        .ep-list-bullet>li {
            position: relative;
            padding-left: 1.5em
        }

        .ep-list-bullet>li::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 1.5em;
            height: 1.5em;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%226%22%20height%3D%226%22%20viewBox%3D%220%200%206%206%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%0A%20%20%20%20%3Ccircle%20fill%3D%22%23666%22%20cx%3D%223%22%20cy%3D%223%22%20r%3D%223%22%20%2F%3E%0A%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: 50% 50%;
            display: block
        }

        hr{
            box-sizing: content-box;
            height: 0;
            overflow: visible;
            text-align: inherit;
            margin: 0 5px 5px 0;
            border: 0;
            border-top: 1px solid #e5e5e5;
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
        <h3 class="ep-title">Oh no! An error occurred.</h3>
        <p><h4><?php echo($errorData['msg']);?></h4></p>
        <span class="ep-path"><?php echo("{$errorData['path']}  (#{$errorData['line']})");?></span>
        <hr>
        <?php foreach($errorData['code'] as $lineNo => $value){ ?>

        <div <?php if($lineNo + 1 === $errorData['line']){ ?> class="ep-error-line" <?php }?> >
            <div>
                <b class="ep-code-index"><?php echo($lineNo + 1);?></b>
                <span>
                    <?php echo(str_replace('&lt;?php','', highlight_string('<?php' . $value, true)));?>
                </span>
            </div>
        </div>
        <?php } ?>
        <hr>
        <span class="ep-subtitle">Run-Time Stack</span>
        <ul class="ep-list ep-list-bullet">
            <?php foreach($errorData['trace'] as $key => $value){?>
                <li class="ep-path"><?php echo((count($errorData['trace']) - $key) . " {$value['file']} (#{$value['line']}) " . implode(' / ', $value['args']));?></li>
            <?php }?>
        </ul>

        <div class="ep-footer"><b><?php echo(EP_FOOTER);?></b> | <?php echo(EP_VERSION);?></div>
    </div>
</body>
</html>