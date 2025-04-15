<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Irrigation Tools</title>
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
    .tabs {
      text-align: center;
      margin-bottom: 20px;
    }
    .tabs button {
      padding: 10px 20px;
      margin: 5px;
      border: none;
      background-color: #e2e8f0;
      cursor: pointer;
      border-radius: 8px;
    }
    .tabs button.active {
      background-color: #38a169;
      color: white;
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

  <h1>💧 Irrigation Tools</h1>
  <p style="text-align:center;">Affordable tools available for purchase or rental</p>

  <div class="tabs">
    <button class="active" onclick="showTab('purchase')">Buy</button>
    <button onclick="showTab('rent')">Rent</button>
  </div>

  <div class="tools-container" id="tools"></div>

  <script>
    const tools = [
      { 
        product_id:101,
        name: "Drip Irrigation System", 
        use: "Water is delivered directly to the root zone of plants", 
        purchase: "₹50,000", 
        rent: "₹5,000/month",
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/Button_dripper.JPG/640px-Button_dripper.JPG" // Replace with actual image URL
      },
      { 
        product_id:102,
        name: "Sprinkler Irrigation System", 
        use: "Water is sprayed over crops using a system of pipes", 
        purchase: "₹40,000", 
        rent: "₹4,000/month",
        image: "https://www.groundsguys.com/us/en-us/grounds-guys/_assets/images/sprinkler-system2.webp" // Replace with actual image URL
      },
      { 
        product_id:103,
        name: "Flood Irrigation System", 
        use: "Fields are flooded with water, allowing it to soak into the soil", 
        purchase: "₹70,000", 
        rent: "₹7,000/month",
        image: "https://d9-wret.s3.us-west-2.amazonaws.com/assets/palladium/production/s3fs-public/styles/teaser/public/thumbnails/image/wss-banner-irrigation-furrow.png?itok=xZ6te2O6" // Replace with actual image URL
      },
      { 
        product_id:104,
        name: "Subsurface Irrigation System", 
        use: "Water is applied below the soil surface through buried pipes", 
        purchase: "₹60,000", 
        rent: "₹6,000/month",
        image: "https://www.geo.fu-berlin.de/en/v/iwrm/Implementation/technical_measures/bilder/Bilder-irrigation/Sub-surface-irrigation.jpg?width=500" // Replace with actual image URL
      },
      { 
        product_id:105,
        name: "Surface Irrigation System", 
        use: "Water is applied directly to the soil surface", 
        purchase: "₹30,000", 
        rent: "₹3,000/month",
        image: "https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/SiphonTubes.JPG/220px-SiphonTubes.JPG" // Replace with actual image URL
      },
      { 
        product_id:106,
        name: "Micro Irrigation System", 
        use: "Water is delivered directly to the root zone of plants using micro tubes", 
        purchase: "₹20,000", 
        rent: "₹2,000/month",
        image: "https://5.imimg.com/data5/ET/EI/MY-11704007/micro-irrigation-system-500x500.png" // Replace with actual image URL
      }
    ];

    let currentTab = 'purchase';

    function showTab(tab) {
      currentTab = tab;
      document.querySelectorAll('.tabs button').forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');
      renderTools();
    }

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
          <p class="price">${tool[currentTab]}</p>
          <button>${currentTab === 'purchase' ? 'Buy Now' : 'Rent Now'}</button>
        `;
        container.appendChild(card);
      });
    }

    renderTools();
   
  </script>

</body>
</html>