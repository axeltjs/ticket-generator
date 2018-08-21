<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ date('d-m-Y') . '-ticket-genrator.pdf' }}</title>
</head>
<body>
    @for($i = $data->start_num; $i <= $data->end_num; $i++)
    <?php 
        $finished_filename = $filename."-".$i.".".$data->extension;
    ?>
    <img style="margin:10px" src="{{ public_path('/uploads/user/'.$finished_filename) }}">
    @endfor
</body>
</html>