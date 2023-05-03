<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body{
            width: 210mm;
            height: 100vh;
            padding: 2%;
            /* background: green; */
        }  
        .quote{
            top:15%;
            transform : transilateY(-20%);
            transform: rotate(-90deg);
            position: absolute;
        }
        .main_col{
            color:orange;
        }
        .top{
            width:65%;
            display: flex;
            margin: auto;
            background-color: yellow;

        }
        .main_cont{
            position: relative;
            top: 30%;
            background-color:aquamarine;
        }
        .top_left{
            width: 50%;
            background-color:green;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="main_cont">

        <h2 class="quote">QUOTE <span class="main_col">#SL/113</span></h2>
        
        <div class="top">
            <div class="top_left">
                <h2 class="main_col">Smart Lab</h2>
                <p>HM GOATHI(10512) C-80 GF,FIHAARA 02</p>
                <p>TIN: 1124975GST501</p>
                <p>9333143</p>
            </div>
            <div class="top_right">
                <img src="http://localhost/logo/smart_lab_logo.png" alt="" srcset="">
            </div>
        </div>
    </div>

</body>
</html>