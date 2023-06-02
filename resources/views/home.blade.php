<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .button {
            padding: 8px;
            text-decoration: none
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="simple-excel">
        <h3>Type 1</h3>
        <button id="upload-btn">Upload</button>
        <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data" id="file" style="display: none">
            @csrf
            <input type="file" name="excel_file">
            <button type="submit" class="button">Import</button>
        </form>
        <a href="{{route('excel.export')}}" class="button">Download</a>
    </div>
    <div class="type2">
        <h3>Type 2</h3>
        <button id="upload-btn2">upload</button>
        <form action="{{ route('type2.import') }}" method="POST" enctype="multipart/form-data" id="file2" style="display: none">
            @csrf
            <input type="file" name="excel_file">
            <button type="submit" class="button">Import</button>
        </form>
        <form action="{{route('type2.export')}}" method="POST">
            @csrf
            <input type="text" name="type2_text">
            <button type="submit">Download</button>
        </form>
    </div>
    <div class="type3">
        <h3>Type 3</h3>
        <button id="upload-btn3">upload</button>
        <form action="{{ route('type3.import') }}" method="POST" enctype="multipart/form-data" id="file3" style="display: none">
            @csrf
            <input type="file" name="excel_file">
            <button type="submit">Import</button>
        </form>
        <form action="{{route('type3.export')}}" method="POST">
            @csrf
            <input type="text" name="type3_text">
            <select name="input_format">
                <option value="0">Please select input type</option>
                <option value="single">Single Line</option>
                <option value="multiple">Multiple Line</option>
                <option value="checkbox">Check Box</option>
            </select>
            <select name="cell_color">
                <option value="0">Please select cell color</option>
                <option value="yellow">yellow</option>
                <option value="blue">blue</option>
                <option value="green">green</option>
            </select>
            <button type="submit">export</button>
        </form>
    </div>
    <script>
        $('#upload-btn').click(function() {
            $('#file').toggle()
        })
        $('#upload-btn2').click(function() {
            $('#file2').toggle()
        })
        $('#upload-btn3').click(function() {
            $('#file3').toggle()
        })
    </script>
</body>
</html>