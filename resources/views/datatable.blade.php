<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <input type="text" name="search" id="search" class="px-4 py-2 border rounded-lg my-5"
        oninput="searching(this.value)">
    <div class="text-xl font-bold mb-5">list data</div>

    <div id="list-data">
    </div>

    {{-- <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> --}}
</body>
<script>
    // FilePond.registerPlugin(FilePondPluginImagePreview);

    // FilePond.create(document.querySelector('input[name="image"]'));

    // FilePond.setOptions({
    //     server: {
    //         process: '/tmp-upload',
    //         revert: '/tmp-delete',
    //         headers: {
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         }
    //     }
    // })

    const data = ['rasikh', 'khalil', 'pasha', 'lagi', 'berak']
    const listData = document.querySelector('#list-data')

    data.forEach((e, i) => listData.innerHTML += `<div>${i+1}. ${e}</div>`)

    function searchingPromise(text) {
        return new Promise((resolve) => {
            console.log('nungguin searcing', text)
            const startTime = new Date();
            setTimeout(() => {
                let found = [];
                data.forEach(e => (e.includes(text)) && found.push(e))

                const endTime = new Date();
                const elapsedTime = endTime - startTime;
                console.log('searching selesai dalam waktu ', elapsedTime)
                resolve(found)
            }, 2000);
        })
    }

    async function showData(res) {
        await new Promise((resolve) => {
            console.log('nugguin render', res)
            const startTime = new Date();
            setTimeout(() => {
                listData.innerHTML = ''

                res.forEach((e, i) => listData.innerHTML += `<div>${i+1}. ${e}</div>`)

                const endTime = new Date();
                const elapsedTime = endTime - startTime;
                console.log('render selesai dalam waktu ', elapsedTime)
            }, 5000);
        })

        console.log('tes')
    }

    async function searching(text = '') {
        listData.innerHTML = 'loading...'

        const res = await new Promise((resolve) => {
            console.log('nungguin searcing', text)
            const startTime = new Date();
            setTimeout(() => {
                let found = data.filter(e => e.includes(text))

                const endTime = new Date();
                const elapsedTime = endTime - startTime;
                console.log('searching selesai dalam waktu ', elapsedTime)
                resolve(found)
            }, 2000);
        })

        showData(res)
    }
</script>

</html>
