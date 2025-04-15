from gtts import gTTS
import os

# Define seed descriptions
seed_audio_data = {
    "groundnut.mp3": "ఇది పల్లీ విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "cotton.mp3": "ఇది పత్తి విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "jowar.mp3": "ఇది జొన్న విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "bajra.mp3": "ఇది సజ్జ విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "redgram.mp3": "Sఇది కంది పప్పు విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "greengram.mp3": "ఇది పచ్చ పప్పు విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "sunflower.mp3": "ఇది సూర్యకాంతి విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కం",
    "maize.mp3": "ఇది మొక్కజొన్న విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "rice.mp3": "ఇది బియ్యం విత్తనం.ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "sugarcane.mp3": "ఇది చెరకు విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి.",
    "banana.mp3": "ఇది అరటి విత్తనం. ఆర్డర్ చేయాలంటే, పచ్చ బటన్‌ను నొక్కండి."
}

# Create an audio directory if not exists
os.makedirs("audio", exist_ok=True)

# Generate audio files
for filename, text in seed_audio_data.items():
    tts = gTTS(text, lang='te')
    tts.save(f"audio/{filename}")

print("✅ Audio files generated successfully.")
