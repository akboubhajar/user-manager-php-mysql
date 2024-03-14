<?php
require_once("utils/tools.php");
session_start();
if(!isset($_SESSION["panier"]))
    $_SESSION['panier'] = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php?</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <h1>ECommerce</h1>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th></th>
                    <th>Description</th>
                    <th>Qunatité</th>
                    <th>Prix</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <tr>
                    <td>
                        <img src="https://picsum.photos/60/60?6567" alt="">
                    </td>
                    <td>Lorem ipsum dolor sit amet consectetur.</td>
                    <td>
                    <input style="text-align:right" type="number"  id="p-1" value="1" class="form-control">
                    </td>
                    <td class="text-right">7670.67$</td>
                    <td class="">
                        <button onclick="add('p-1')" class="btn btn-outline-primary"><i class="bi bi-cart"</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="https://picsum.photos/60/60?567" alt="">
                    </td>
                    <td>Lorem ipsum dolor sit amet consectetur.</td>
                    <td>
                    <input style="text-align:right" type="number"  id="p-2" value="1" class="form-control">
                    </td>
                    <td class="text-right">9990.67$</td>
                    <td class="">
                        <button onclick="add('p-2')" class="btn btn-outline-primary"><i class="bi bi-cart"</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="https://picsum.photos/60/60?67" alt="">
                    </td>
                    <td>Lorem ipsum dolor sit amet consectetur.</td>
                    <td>
                    <input style="text-align:right" type="number"  id="p-3" value="1" class="form-control">
                    </td>
                    <td class="text-right">70.67$</td>
                    <td class="">
                        <button onclick="add('p-3')" class="btn btn-outline-primary"><i class="bi bi-cart"</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="https://picsum.photos/60/60?656700" alt="">
                    </td>
                    <td>Lorem ipsum dolor sit amet consectetur.</td>
                    <td>
                    <input style="text-align:right" type="number"  id="p-4" value="1" class="form-control">
                    </td>
                    <td class="text-right">77990.67$</td>
                    <td class="">
                        <button onclick="add('p-4')" class="btn btn-outline-primary"><i class="bi bi-cart"</button>
                    </td>
                </tr>
            </tbody>
        </table>

    <script>
        function add(ref) {
            const qty =document.querySelector('#' + ref).value
            // location.href = 'add.php?ref=' + ref + '&qty=' + qty

            fetch('add.php?ref=' + ref + '&qty=' + qty)
            .then(res => res.json())
            .then(show)
        }

        function show(data) {
            const pre = document.querySelector('.panier')
            pre.innerText = JSON.stringify(data, null, 4 )    
        }
    </script>
    
        <hr>
        <pre class="panier"></pre>
        <hr>
    <?php
    log_r($_SESSION)
    ?>
</body>
</html>