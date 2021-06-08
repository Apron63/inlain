<?php
?>

<html lang="ru">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Test</title>
</head>
<body>
<form>
    <label>
        <input id="findValue" name="findValue">
    </label>
    <button id="askButton" type="button">Найти</button>
</form>

<div id="searchResult"></div>

<script>
    $("#askButton").click(function () {
        let data = $("#findValue").val();
        if (data.length >= 3) {
            $.ajax({
                url: "askDb.php",
                data: {term: data}
            }).done(function (data) {
                if (data) {
                    let content = "<table border='1'>";
                    JSON.parse(data).forEach(function (e) {
                        console.log(e.title);
                        content = content + "<tr>" + "<td>" + e.title + "</td><td>" + e.body + "</td>";
                    });
                    content = content + "</table>";
                    $("#searchResult").html(content);
                }
            }).fail(function (data) {
                console.log(data);
            });
        }
    });
</script>
</body>
</html>


