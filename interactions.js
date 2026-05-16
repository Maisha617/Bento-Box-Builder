function updatePreview(selectName, imgId, folder) {
    const value = document.querySelector(`select[name="${selectName}"]`).value;
    const img = document.getElementById(imgId);

    if (!value) {
        img.style.display = "none";
        return;
    }

    img.src = `../images/Bento Items Images/${folder}/${value}.png`;
    img.style.display = "block";
}

// Attach listeners
document.querySelector('select[name="main"]').addEventListener("change", () =>
    updatePreview("main", "mainPreview", "Mains")
);

document.querySelector('select[name="side"]').addEventListener("change", () =>
    updatePreview("side", "sidePreview", "Sides")
);

document.querySelector('select[name="drink"]').addEventListener("change", () =>
    updatePreview("drink", "drinkPreview", "Drinks")
);

document.querySelector('select[name="sauce"]').addEventListener("change", () =>
    updatePreview("sauce", "saucePreview", "Sauces")
);
