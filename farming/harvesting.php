<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harvesting Techniques | Earthworm</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('https://images.unsplash.com/photo-1605733160314-4a4e06e8a0c1');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 20px;
      color: #333;
    }
    h1, h2 {
      color: #2e7d32;
    }
    .technique {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    select {
      padding: 8px;
      margin: 10px 10px 20px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      padding: 10px 16px;
      margin: 10px 10px 20px 0;
      border-radius: 8px;
      background-color: #2e7d32;
      color: white;
      border: none;
      cursor: pointer;
    }
    .tips {
      background-color: rgba(232, 245, 233, 0.9);
      padding: 15px;
      border-left: 4px solid #66bb6a;
      margin-top: 20px;
      border-radius: 8px;
    }
    .technique { display: none; }
    #voice-output { margin-top: 20px; font-weight: bold; }
  </style>
</head>
<body>
  <h1>Harvesting Techniques</h1>

  <label for="crop-select">Choose your crop:</label>
  <select id="crop-select" onchange="filterOptions()">
    <option value="">--Select Crop--</option>
    <option value="paddy">Paddy</option>
    <option value="wheat">Wheat</option>
    <option value="carrot">Carrot</option>
  </select>

  <label for="land-select">Select land size:</label>
  <select id="land-select" onchange="filterOptions()">
    <option value="">--Select Size--</option>
    <option value="small">Small</option>
    <option value="medium">Medium</option>
    <option value="large">Large</option>
  </select>

  <button onclick="speakVisibleTechnique()">🔊 Speak Instructions</button>
  <button onclick="startVoiceRecognition()">🎤 Voice Input</button>

  <div id="voice-output"></div>

  <div class="technique" data-crops="paddy" data-sizes="small,medium">
    <h2>Manual Harvesting for Paddy</h2>
    <p>Ideal for small to medium-sized paddy fields using sickles or cutters.</p>
    <ul>
      <li><strong>Tools Used:</strong> Sickle, knife</li>
      <li><strong>Type:</strong> Manual</li>
    </ul>
  </div>

  <div class="technique" data-crops="paddy" data-sizes="large">
    <h2>Mechanical Harvesting for Paddy</h2>
    <p>Recommended for large paddy farms using combine harvesters.</p>
    <ul>
      <li><strong>Machines Used:</strong> Combine harvester</li>
      <li><strong>Type:</strong> Mechanical</li>
    </ul>
  </div>

  <div class="technique" data-crops="wheat" data-sizes="small,medium">
    <h2>Manual Harvesting for Wheat</h2>
    <p>Suitable for small and medium wheat fields using sickles.</p>
    <ul>
      <li><strong>Tools Used:</strong> Sickle, scythe</li>
      <li><strong>Type:</strong> Manual</li>
    </ul>
  </div>

  <div class="technique" data-crops="wheat" data-sizes="large">
    <h2>Mechanical Harvesting for Wheat</h2>
    <p>Best for large wheat farms using combine harvesters.</p>
    <ul>
      <li><strong>Machines Used:</strong> Combine harvester, tractor-mounted reaper</li>
      <li><strong>Type:</strong> Mechanical</li>
    </ul>
  </div>

  <div class="technique" data-crops="carrot" data-sizes="small,medium">
    <h2>Manual Harvesting for Carrot</h2>
    <p>Used for small to medium plots where carrots are hand-pulled or dug out.</p>
    <ul>
      <li><strong>Tools Used:</strong> Digging fork, hand</li>
      <li><strong>Type:</strong> Manual</li>
    </ul>
  </div>

  <div class="technique" data-crops="carrot" data-sizes="large">
    <h2>Mechanical Harvesting for Carrot</h2>
    <p>For large-scale carrot farming using root crop harvesters.</p>
    <ul>
      <li><strong>Machines Used:</strong> Root crop harvester</li>
      <li><strong>Type:</strong> Mechanical</li>
    </ul>
  </div>

  <div class="tips">
    <h3>✅ Harvesting Tips</h3>
    <ul>
      <li>Harvest in the morning or late afternoon to avoid heat damage</li>
      <li>Clean and sort crops immediately after harvest</li>
      <li>Store in cool, dry places or cold storage if needed</li>
    </ul>
  </div>

  <script>
    function filterOptions() {
      const crop = document.getElementById("crop-select").value;
      const size = document.getElementById("land-select").value;
      const techniques = document.querySelectorAll(".technique");
      techniques.forEach(tech => {
        const crops = tech.getAttribute("data-crops").split(",");
        const sizes = tech.getAttribute("data-sizes").split(",");
        if ((crops.includes(crop)) && (sizes.includes(size))) {
          tech.style.display = "block";
        } else {
          tech.style.display = "none";
        }
      });
    }

    function speakVisibleTechnique() {
      const synth = window.speechSynthesis;
      const techniques = document.querySelectorAll(".technique");
      let contentToSpeak = "";

      techniques.forEach(tech => {
        if (tech.style.display === "block") {
          contentToSpeak += tech.innerText + "\n";
        }
      });

      if (contentToSpeak.trim()) {
        const utterance = new SpeechSynthesisUtterance(contentToSpeak);
        utterance.lang = 'en-US';
        synth.speak(utterance);
      }
    }

    function startVoiceRecognition() {
      if (!('webkitSpeechRecognition' in window)) {
        alert("Sorry, your browser doesn't support voice recognition.");
        return;
      }

      const recognition = new webkitSpeechRecognition();
      recognition.lang = 'en-US';
      recognition.interimResults = false;
      recognition.maxAlternatives = 1;

      recognition.start();

      recognition.onresult = (event) => {
        const result = event.results[0][0].transcript.toLowerCase();
        document.getElementById('voice-output').innerText = "You said: " + result;

        const crops = ['paddy', 'wheat', 'carrot'];
        const sizes = ['small', 'medium', 'large'];

        let selectedCrop = crops.find(crop => result.includes(crop));
        let selectedSize = sizes.find(size => result.includes(size));

        if (selectedCrop) {
          document.getElementById("crop-select").value = selectedCrop;
        }
        if (selectedSize) {
          document.getElementById("land-select").value = selectedSize;
        }

        if (selectedCrop && selectedSize) {
          filterOptions();
        }
      };

      recognition.onerror = (event) => {
        console.error("Voice recognition error:", event.error);
        document.getElementById('voice-output').innerText = "Error recognizing speech.";
      };
    }
  </script>
</body>
</html>