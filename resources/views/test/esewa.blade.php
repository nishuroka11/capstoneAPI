<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="content">
    <form action="https://uat.esewa.com.np/epay/main" method="POST">
        <input value="100" name="tAmt" type="hidden">
        <input value="90" name="amt" type="hidden">
        <input value="5" name="txAmt" type="hidden">
        <input value="2" name="psc" type="hidden">
        <input value="3" name="pdc" type="hidden">
        <input value="epay_payment" name="scd" type="hidden">
        <input value="123456789147" name="pid" type="hidden">
        <input value="http://laraboiler.local/esewa-testing?q=su" type="hidden" name="su">
        <input value="http://laraboiler.local/esewa-testing?q=fu" type="hidden" name="fu">
        <input value="Submit" type="submit">
    </form>
</body>
</html>
