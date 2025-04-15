<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User's View - Browse Products</title>
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
    .product-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 30px;
    }
    .product-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 250px;
      text-align: center;
      padding: 15px;
    }
    .product-card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
    }
    .product-name {
      font-size: 18px;
      font-weight: bold;
      margin: 10px 0;
      color: #2f855a;
    }
    .product-price {
      font-size: 16px;
      color: #22543d;
    }
    .product-description {
      font-size: 14px;
      color: #2d3748;
    }
    .add-to-cart-btn {
      margin-top: 10px;
      padding: 8px 15px;
      background-color: #38a169;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    /* Cart styling */
    .cart-section {
      margin-top: 50px;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
      padding: 20px;
    }
    .cart-section h2 {
      text-align: center;
      color: #2c7a7b;
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #e2e8f0;
    }
    .cart-item:last-child {
      border-bottom: none;
    }
    .cart-item-name {
      font-weight: bold;
      color: #2f855a;
    }
    .cart-item-price {
      color: #4a5568;
    }
  </style>
</head>
<body>

  <h1>User's Menu - Browse Products</h1>

  <div class="product-container" id="productList">
    <!-- Products from Farmer will be displayed here -->
  </div>

  <!-- 🛒 Cart Section -->
  <div class="cart-section" id="cartSection">
    <h2>🛒 Your Cart</h2>
    <div id="cartItems">
      <p style="text-align:center;">Your cart is empty.</p>
    </div>
  </div>

  <script>
    // Get the products from localStorage
let products = JSON.parse(localStorage.getItem('products')) || [];

// Store cart items in localStorage (or init empty array)
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to display products for users
function displayProducts() {
  const productContainer = document.getElementById('productList');
  productContainer.innerHTML = ''; // Clear existing products

  products.forEach((product, index) => {
    const productCard = document.createElement('div');
    productCard.classList.add('product-card');
    productCard.innerHTML = `
      <img src="product-image.jpg" alt="${product.name}" />
      <div class="product-name">${product.name}</div>
      <div class="product-price">₹${product.price} per kg</div>
      <div class="product-description">${product.description}</div>
      <button class="add-to-cart-btn" onclick="addToCart(${index})">Add to Cart</button>
    `;
    productContainer.appendChild(productCard);
  });
}

// Function to add a product to the cart
function addToCart(index) {
  const product = products[index];
  cart.push(product);
  localStorage.setItem('cart', JSON.stringify(cart));
  alert(`${product.name} added to the cart!`);
  displayCart();
}

// Function to display cart items
function displayCart() {
  const cartItemsContainer = document.getElementById('cartItems');
  cartItemsContainer.innerHTML = '';

  if (cart.length === 0) {
    cartItemsContainer.innerHTML = `<p style="text-align:center;">Your cart is empty.</p>`;
    return;
  }

  cart.forEach(item => {
    const cartItem = document.createElement('div');
    cartItem.classList.add('cart-item');
    cartItem.innerHTML = `
      <div class="cart-item-name">${item.name}</div>
      <div class="cart-item-price">₹${item.price} per kg</div>
    `;
    cartItemsContainer.appendChild(cartItem);
  });
}

// Display products and cart on page load
displayProducts();
displayCart();
  </script>

</body>
</html>