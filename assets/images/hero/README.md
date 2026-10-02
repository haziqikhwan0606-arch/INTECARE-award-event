# INTECARE 2026 — Hero Multi-Image Editorial Collage Assets

This directory contains the independent, modular image assets for the **INTECARE 2026** homepage hero visual collage. 

Each visual element is loaded as an independent HTML `<img>` element within the `.hero-collage-container`, positioned via CSS variables and absolute layering, and can be replaced at any time simply by replacing its local image file.

---

## 1. Transparent PNG & Multi-Format Support

The hero collage fully supports:
- **Transparent PNGs:** Cutout figures, 3D bio-tech sculptures, floating badges, and organic shapes with alpha channels.
- **Transparent WebPs:** Modern WebP format with alpha transparency.
- **Regular JPGs:** Rectangular photography and framed editorial panels.

### Automatic Transparent Layer Behaviour:
When an image is a `.png`, `.webp`, or has the class `.is-transparent`:
1. **Full Alpha Transparency Preserved:** No white backgrounds, no solid rectangular cards, no forced circular borders, and no container clipping (`overflow: visible`).
2. **`object-fit: contain`:** The image silhouette is maintained without stretching or cropping.
3. **Contoured 3D Drop-Shadow:** Instead of a rectangular `box-shadow`, the shadow uses CSS `filter: drop-shadow(...)` that clings directly to the alpha silhouette of the cutout.
4. **Natural Overlap:** Elements extend beyond their bounding boxes and overlap adjacent layers naturally.

---

## 2. Asset Directory Locations

All paths point to the same asset files:
- **Primary Native Path:** `assets/images/hero/`
- **Public Hero Path:** `public/images/hero/` *(Symlinked for framework convenience)*
- **Public Intecare Path:** `public/images/intecare/hero/` *(Symlinked for framework convenience)*

---

## 3. Image Layer Specification & Positioning Table

| Layer Name & Visual Purpose | Filename(s) | CSS Layer Class | CSS Position & Size Properties | Stacking Order (Z-Index) | Format & Aspect Ratio |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Layer 1: Abstract Technology**<br>Deep background data matrix / scientific depth | `hero-abstract-technology.png`<br>`hero-abstract-technology.jpg` | `.collage-layer-abstract` | `--abstract-w: 34%`<br>`--abstract-top: 8%`<br>`--abstract-left: 35%`<br>`--abstract-rotate: 0deg` | `z-index: 1`<br>*(Deep Background)* | Transparent PNG / JPG<br>1:1 square |
| **Layer 2: Healthcare Innovation**<br>Clinical research & microscopy panel | `hero-healthcare-innovation.jpg`<br>`hero-healthcare-innovation.png` | `.collage-layer-innovation` | `--innovation-w: 38%`<br>`--innovation-top: 2%`<br>`--innovation-right: 2%`<br>`--innovation-rotate: 0deg` | `z-index: 2`<br>*(Upper Right Panel)* | JPG photo / PNG<br>1:1 or 4:3 |
| **Layer 3: Healthcare Architecture**<br>Modern hospital skyscraper with angular crop | `hero-architecture.jpg`<br>`hero-architecture.png` | `.collage-layer-architecture` | `--arch-w: 36%`<br>`--arch-bottom: 2%`<br>`--arch-right: 2%`<br>`--arch-rotate: 0deg` | `z-index: 3`<br>*(Lower Right Panel)* | JPG photo / PNG<br>4:5 vertical (angular clip) |
| **Layer 4: Main Healthcare Portrait**<br>Visionary leader / researcher (anchor ~55%) | `hero-main-portrait.jpg`<br>`hero-main-portrait.png` | `.collage-layer-portrait` | `--portrait-w: 52%`<br>`--portrait-top: 4%`<br>`--portrait-left: 17%`<br>`--portrait-rotate: 0deg` | `z-index: 4`<br>*(Central Anchor)* | JPG photo or Cutout PNG<br>4:5 portrait |
| **Layer 5: Medical Technology**<br>3D fluid bio-diagnostic orb cutout | `hero-medical-technology.png`<br>`hero-medical-technology.jpg` | `.collage-layer-medtech` | `--medtech-w: 35%`<br>`--medtech-bottom: 6%`<br>`--medtech-left: 2%`<br>`--medtech-rotate: -2deg` | `z-index: 5`<br>*(Foreground Cutout)* | **Transparent PNG**<br>1:1 square cutout |
| **Layer 6: Wellness & Vitality**<br>Organic vitality / preventive health band | `hero-wellness.jpg`<br>`hero-wellness.png` | `.collage-layer-wellness` | `--wellness-w: 42%`<br>`--wellness-bottom: 1%`<br>`--wellness-left: 30%`<br>`--wellness-rotate: 0deg` | `z-index: 6`<br>*(Foreground Accent)* | JPG photo / PNG<br>2:1 or 16:9 landscape |
| **Layer 7: Supporting Visual**<br>Editorial badge ("People • Innovation • Impact") | `hero-supporting-visual.png`<br>`hero-supporting-visual.jpg` | `.collage-layer-supporting` | `--supporting-w: 22%`<br>`--supporting-top: 4%`<br>`--supporting-left: 2%`<br>`--supporting-rotate: 3deg` | `z-index: 7`<br>*(Top Foreground Badge)* | **Transparent PNG**<br>1:1 circular cutout |

---

## 4. How to Customize and Reposition Layers

### Option A: Edit Position, Size, or Rotation in CSS
Open [`assets/css/style.css`](../../css/style.css) and locate `.hero-collage-container` (around line 378). You can change any of the custom properties:
```css
.hero-collage-container {
  --portrait-w: 52%;      /* Width of main portrait */
  --portrait-left: 17%;   /* Horizontal position */
  --medtech-rotate: -2deg;/* Rotation tilt */
  /* ... */
}
```

### Option B: Replace an Image File Locally
1. Save your image with the matching filename (e.g. `hero-medical-technology.png`).
2. If using a transparent PNG, ensure the background is transparent alpha.
3. Replace the file in `assets/images/hero/` (or `public/images/hero/`).
4. Hard refresh the browser (`Cmd + Shift + R`). The collage updates immediately without modifying any HTML, CSS, or JS.

---

## 5. Central JavaScript Configuration

In [`assets/js/main.js`](../../js/main.js):
```javascript
const heroImages = {
  portrait: "assets/images/hero/hero-main-portrait.jpg",
  medicalTechnology: "assets/images/hero/hero-medical-technology.png",
  healthcareInnovation: "assets/images/hero/hero-healthcare-innovation.jpg",
  architecture: "assets/images/hero/hero-architecture.jpg",
  wellness: "assets/images/hero/hero-wellness.jpg",
  abstractTechnology: "assets/images/hero/hero-abstract-technology.png",
  supportingVisual: "assets/images/hero/hero-supporting-visual.png"
};
```
