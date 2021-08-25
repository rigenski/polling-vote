<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css " />
</head>
<body>
    @yield('main')
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script>
        function showForm() {
            var form = document.getElementById('form-poll');

            if(form.style.display == 'none') {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        $(document).ready(function() {
            $(".add").click(function() {
                var html = $(".copy").html();
                $(".after").after(html);
            })
        })
    </script>
</body>
</html>