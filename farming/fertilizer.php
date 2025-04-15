<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fertilizers</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8fafc;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #2d3748;
    }
    .tools-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }
    .card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      text-align: center;
    }
    .card img {
      max-width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .card h2 {
      margin-top: 0;
      color: #2f855a;
    }
    .price {
      font-size: 18px;
      color: #2b6cb0;
      margin: 10px 0;
    }
    .card button {
      width: 100%;
      padding: 10px;
      background-color: #38a169;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <h1>🌱 Fertilizers</h1>
  <p style="text-align:center;">Affordable fertilizers available for purchase</p>

  <div class="tools-container" id="tools"></div>

  <script>
    const tools = [
      { 
        name: "Nitrogen Fertilizer", 
        use: "Promotes leafy growth in plants", 
        purchase: "₹1,000",
        image: "https://tiimg.tistatic.com/fp/1/007/569/highly-effective-fast-acting-nitrogen-fertilizer-liquid-nitrogen-lawn-food-292.jpg" // Replace with actual image URL
      },
      { 
        name: "Phosphorus Fertilizer", 
        use: "Enhances root development and flowering", 
        purchase: "₹1,200",
        image: "https://m.media-amazon.com/images/I/719wTVdzkYL.jpg" // Replace with actual image URL
      },
      { 
        name: "Potassium Fertilizer", 
        use: "Improves overall plant health and disease resistance", 
        purchase: "₹1,500",
        image: "https://m.media-amazon.com/images/I/71yx7NGeT3L.AC_UF1000,1000_QL80.jpg" // Replace with actual image URL
      },
      { 
        name: "Organic Fertilizer", 
        use: "Enhances soil fertility and structure", 
        purchase: "₹800",
        image: "https://m.media-amazon.com/images/I/91Y3l-BVm-L.jpg" // Replace with actual image URL
      },
      { 
        name: "Slow-Release Fertilizer", 
        use: "Provides nutrients over an extended period", 
        purchase: "₹1,800",
        image: "https://www.jiomart.com/images/product/original/rvaptaprut/sansar-green-slow-release-fertilizer-organic-granules-for-fertilzing-plants-upto-6-months-400-gm-product-images-orvaptaprut-p606597724-0-202312071058.jpg?im=Resize=(420,420)" // Replace with actual image URL
      },
      { 
        name: "Liquid Fertilizer", 
        use: "Quickly provides nutrients to plants", 
        purchase: "₹1,000",
        image: "https://m.media-amazon.com/images/I/71f8vQatu6L.jpg" // Replace with actual image URL
      },
      { 
        name: "Calcium Fertilizer", 
        use: "Strengthens cell walls and promotes root growth", 
        purchase: "₹900",
        image: "https://m.media-amazon.com/images/I/71q9ZStBRyL.jpg"
      },
      { 
        name: "Magnesium Fertilizer", 
        use: "Essential for photosynthesis and plant health", 
        purchase: "₹1,100",
        image: "https://m.media-amazon.com/images/I/51vRF3eGhzL.AC_UF1000,1000_QL80.jpg"
      },
      { 
        name: "Sulfur Fertilizer", 
        use: "Improves protein synthesis and enzyme function", 
        purchase: "₹950",
        image: "https://5.imimg.com/data5/WA/VJ/ZQ/SELLER-25464873/sulphur-90-wdg.jpg"
      },
      { 
        name: "Zinc Fertilizer", 
        use: "Promotes growth and development in plants", 
        purchase: "₹1,300",
        image: "https://m.media-amazon.com/images/I/71i0uIAYOhL.jpg"
      },
      { 
        name: "Iron Fertilizer", 
        use: "Essential for chlorophyll production", 
        purchase: "₹1,400",
        image: "https://cdn.shopify.com/s/files/1/0722/2059/files/multiplex-iron-micronutrient-fertilizer-file-3714.png?v=1737428002"
      },
      { 
        name: "Boron Fertilizer", 
        use: "Essential for cell wall formation and reproductive growth", 
        purchase: "₹1,050",
        image: "https://m.media-amazon.com/images/I/71MroTeRPnL.AC_UF1000,1000_QL80.jpg"
      },
      { 
        name: "Manganese Fertilizer", 
        use: "Important for photosynthesis and nitrogen metabolism", 
        purchase: "₹1,200",
        image: "https://m.media-amazon.com/images/I/71HjGEnTpvL.AC_UF1000,1000_QL80.jpg"
      },
      { 
        name: "Copper Fertilizer", 
        use: "Essential for photosynthesis and plant metabolism", 
        purchase: "₹1,300",
        image: "https://m.media-amazon.com/images/I/71v6PU44xsL.jpg"
      },
      { 
        name: "Selenium Fertilizer", 
        use: "Helps in plant growth and disease resistance", 
        purchase: "₹1,600",
        image: "https://www.pulcutarim.com/wp-content/uploads/2022/03/selenium.png"
      },
      { 
        name: "Humic Acid Fertilizer", 
        use: "Improves soil structure and nutrient availability", 
        purchase: "₹1,200",
        image: "https://m.media-amazon.com/images/I/61hCV6ZszJL.AC_UF1000,1000_QL80.jpg"
      },
      { 
        name: "Compost Fertilizer", 
        use: "Enhances soil fertility and microbial activity", 
        purchase: "₹700",
        image: "https://utkarshagro.com/cdn/shop/files/Prom-04.png?v=1736093789&width=1946"
      }
    ];

    function renderTools() {
      const container = document.getElementById('tools');
      container.innerHTML = '';
      tools.forEach(tool => {
        const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `
          <img src="${tool.image}" alt="${tool.name}" />
          <h2>${tool.name}</h2>
          <p>${tool.use}</p>
          <p class="price">${tool.purchase}</p>
          <button>Buy Now</button>
        `;
        container.appendChild(card);
      });
    }

    renderTools();
  </script>

</body>
</html>