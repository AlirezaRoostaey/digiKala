<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
        .output {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card img {
            max-width: 100%;
            border-radius: 8px;
        }
        .price {
            color: green;
            font-weight: bold;
        }
    </style>


</head>
<body>

<div class="container">
    <h2>Input Form</h2>
    <input type="text" id="userInput" placeholder="Enter something...">
    <button id="sendRequest">Submit</button>
    <div class="output" id="outputArea"></div>
</div>


<div id="product-list"></div>


<script>
    document.getElementById('sendRequest').addEventListener('click', function() {
        const slug = document.getElementById('userInput').value
        fetch('search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ slug: slug }) // Replace with your data
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json(); // or response.text() based on your server response
            })
            .then(data => {
                console.log('Success:', data);
                displayProducts(data.data)
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    function showProduct(productId){
        fetch('product/'+productId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json(); // or response.text() based on your server response
            })
            .then(data => {
                console.log('Success:', data);
                displayProduct(data.data)
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    function displayProduct(product) {
        console.log('hereeeee')
        console.log(product)
        const productList = document.getElementById('product-list');
        productList.innerHTML = '';

        const card = document.createElement('div');
        card.className = 'card';

        card.innerHTML = `
            <img src="${product.image}" alt="${product.title}">
            <img src="${product.image2}" alt="${product.title}">
            <h3>${product.title}</h3>
            <p class="price">${new Intl.NumberFormat().format(product.price)} IRR</p>`;

        productList.appendChild(card);
    }

    function displayProducts(products) {
        const productList = document.getElementById('product-list');
        productList.innerHTML = ''; // Clear existing content


        products.forEach(product => {
            const card = document.createElement('div');
            card.className = 'card';

            card.innerHTML = `
            <img src="${product.image}" alt="${product.title}">
            <h3>${product.title}</h3>
            <p class="price">${new Intl.NumberFormat().format(product.price)} IRR</p>
            <button onclick="showProduct(${product.id})">مشاهده</button>
        `;

            productList.appendChild(card);
        });
    }
</script>

</body>
</html>
