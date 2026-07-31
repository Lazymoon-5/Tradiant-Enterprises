#!/usr/bin/env python3
"""
Creates placeholder transparent PNG hero images for testing.
Replace these with your actual dad's photos.
"""
from PIL import Image, ImageDraw, ImageFont
import os

heroes = [
    ("supervisor",   "👷 SUPERVISOR",   "#ea8200"),
    ("electrician",  "⚡ ELECTRICIAN",   "#ffd700"),
    ("plumber",      "🔧 PLUMBER",      "#4a9eff"),
    ("mason",        "🧱 MASON",        "#c87941"),
]

out = os.path.join(os.path.dirname(__file__), "assets/images/heroes")
os.makedirs(out, exist_ok=True)

for fname, label, color in heroes:
    img = Image.new("RGBA", (300, 500), (0, 0, 0, 0))
    draw = ImageDraw.Draw(img)
    # silhouette rectangle
    draw.rounded_rectangle([60, 20, 240, 480], radius=20, fill=(30, 25, 15, 200), outline=color, width=2)
    # label text
    try:
        font = ImageFont.truetype("/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf", 22)
    except:
        font = ImageFont.load_default()
    draw.text((150, 250), label, fill=color, font=font, anchor="mm")
    img.save(os.path.join(out, f"{fname}.png"), "PNG")
    print(f"Created {fname}.png")

print("\nPlaceholders ready! Replace with real transparent PNGs.")
