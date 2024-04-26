document.addEventListener('DOMContentLoaded', function () {
 const searchResults = [
        { 
            image: "property1.jpg",
            name: "Property 1",
            address: "123 Main St",
            price: "$250,000",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in velit vel libero maximus congue."
        },
        { 
            image: "property2.jpg",
            name: "Property 2",
            address: "456 Elm St",
            price: "$300,000",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in velit vel libero maximus congue."
        },
        { 
            image: "property2.jpg",
            name: "Property 3",
            address: "456 Loren St",
            price: "$300,000",
            description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in velit vel libero maximus congue."
        }
    ];

    function generatePropertyCards(results) {
        const propertyList = document.getElementById('property-list');

        propertyList.innerHTML = '';

        results.forEach(property => {
            const card = document.createElement('div');
            card.classList.add('property-card');

            const img = document.createElement('img');
            img.src = property.image;
            img.alt = property.name;

            const details = document.createElement('div');
            details.classList.add('property-details');
            details.innerHTML = `
                <h2>${property.name}</h2>
                <p>Address: ${property.address}</p>
                <p>Price: ${property.price}</p>
                <button class="view-details-btn">View Details</button>
            `;

            card.appendChild(img);
            card.appendChild(details);
            propertyList.appendChild(card);

            // Add event listener to the "View Details" button to open modal
            const viewDetailsBtn = details.querySelector('.view-details-btn');
            viewDetailsBtn.addEventListener('click', function() {
                openModal(property);
            });
        });
    }

    generatePropertyCards(searchResults);

    // Modal functionality
    const modal = document.getElementById('property-modal');
    const modalContent = document.querySelector('.modal-content');
    const modalPropertyDetails = document.getElementById('modal-property-details');
    const closeModalBtn = document.querySelector('.close');

    function openModal(property) {
        modal.style.display = 'block';
        modalPropertyDetails.innerHTML = `
            <img src="${property.image}" alt="${property.name}">
            <p><strong>Name:</strong> ${property.name}</p>
            <p><strong>Address:</strong> ${property.address}</p>
            <p><strong>Price:</strong> ${property.price}</p>
            <p><strong>Description:</strong> ${property.description}</p>
        `;
    }

    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});
