<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Farmer's View - Add Product</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9fafb;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #22543d;
    }
    .form-container {
      width: 60%;
      margin-bottom: 30px;
    }
    input, textarea {
      padding: 8px;
      margin: 10px;
      width: 100%;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .form-btn {
      padding: 10px 20px;
      background-color: #38a169;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }
    .product-table {
      width: 100%;
      margin-top: 30px;
      border-collapse: collapse;
      text-align: left;
    }
    .product-table th, .product-table td {
      padding: 10px;
      border: 1px solid #ddd;
    }
    .product-table th {
      background-color: #2f855a;
      color: white;
    }
  </style>
</head>
<body>

  <h1>Farmer's View - Add Your Product</h1>

  <div class="form-container">
    <h2>Product Listing Form</h2>
    <input type="text" id="productName" placeholder="Product Name" required />
    <input type="number" id="productPrice" placeholder="Price per kg (₹)" required />
    <input type="number" id="productQuantity" placeholder="Quantity (kg)" required />
    <textarea id="productDescription" placeholder="Product Description" rows="3"></textarea>
    <button class="form-btn" onclick="addProduct()">Add Product</button>
  </div>

  <h2>Farmer's Listed Products</h2>
  <table class="product-table" id="productTable">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Price (₹)</th>
        <th>Quantity (kg)</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <!-- Product rows will be inserted here -->
    </tbody>
  </table>

  <script>
    // Get products from localStorage or initialize as empty array
    let products = JSON.parse(localStorage.getItem('products')) || [];

    // Function to add product to the table and store in localStorage
    function addProduct() {
      const name = document.getElementById('productName').value;
      const price = parseFloat(document.getElementById('productPrice').value);
      const quantity = parseInt(document.getElementById('productQuantity').value);
      const description = document.getElementById('productDescription').value;

      if (!name || !price || !quantity) {
        alert("Please fill in all the fields.");
        return;
      }

      // Create product object
      const product = {
        name,
        price,
        quantity,
        description
      };

      // Add the product to the products array
      products.push(product);

      // Store the products array in localStorage
      localStorage.setItem('products', JSON.stringify(products));

      // Clear the form inputs
      document.getElementById('productName').value = '';
      document.getElementById('productPrice').value = '';
      document.getElementById('productQuantity').value = '';
      document.getElementById('productDescription').value = '';

      // Update product table
      updateProductTable();
    }

    // Function to update the product table
    function updateProductTable() {
      const tableBody = document.getElementById('productTable').getElementsByTagName('tbody')[0];
      tableBody.innerHTML = ''; // Clear existing table rows

      products.forEach((product) => {
        const row = tableBody.insertRow();
        row.innerHTML = `
          <td>${product.name}</td>
          <td>₹${product.price}</td>
          <td>${product.quantity} kg</td>
          <td>${product.description}</td>
        `;
      });
    }

    // Update the table when the page loads
    updateProductTable();
  </script>

</body>
</html>