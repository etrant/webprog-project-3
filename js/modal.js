// Function to open modal
async function openModal(card_id) {
	await fetch(`property_single.php?id=${card_id}`)
		.then((response) => response.json())
		.then((data) => {
			data.forEach((property) => {
				document.getElementById(
					"image"
				).innerHTML = ` <img src="./img/img${property.id}.webp">`;
				document.getElementById("price").innerHTML = `$${Number(
					property.price
				).toLocaleString()}`;
				document.getElementById(
					"specs"
				).innerHTML = `<li><b>${property.beds}</b> bds</li>
                            <li><b>${property.bathrooms}</b> ba</li>
                            <li><b>${property.square_footage}</b> sqft</li>`;

				document.getElementById(
					"address"
				).innerHTML = `${property.address}, ${property.city}, ${property.state} ${property.zipcode}`;

				document.getElementById(
					"summary"
				).innerHTML = `${property.description}`;
			});
		})
		.catch((error) => console.error("Error fetching data:", error));

	var modal = document.getElementById("modal");
	modal.style.display = "block";
	document.body.style.overflow = "hidden"; // Disable scroll
}
// Function to close modal
function closeModal() {
	var modal = document.getElementById("modal");
	modal.style.display = "none";
	document.body.style.overflow = "scroll"; // Enable scroll
}

// Close modal when clicking outside of it
window.onclick = function (event) {
	var modal = document.getElementById("modal");
	if (event.target == modal) {
		closeModal();
	}
};
