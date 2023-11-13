<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <form action="/tmp-upload" method="post" enctype="multipart/form-data">
        @csrf
        <!--  For single file upload  -->
        <input type="file" name="image" />

        <button type="submit">Submit</button>
    </form>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</body>
<script>
    FilePond.registerPlugin(FilePondPluginImagePreview);
    
    FilePond.create(document.querySelector('input[name="image"]'));

    FilePond.setOptions({
        server: {
            process: '/tmp-upload',
            revert: '/tmp-delete',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    })
</script>

</html>
