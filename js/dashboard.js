document.addEventListener('DOMContentLoaded', function () {
   // This is for testing purposes will be replaced 
    const searchResults = [
        { 
            image: "property1.jpg",
            name: "Property 1",
            address: "123 Main St",
            price: "$250,000"
        },
        { 
            image: "property2.jpg",
            name: "Property 2",
            address: "456 Elm St",
            price: "$300,000"
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
                <p class="price">Price: ${property.price}</p>
                <button>View Details</button>
            `;

            card.appendChild(img);
            card.appendChild(details);
            propertyList.appendChild(card);
        });
    }

    generatePropertyCards(searchResults);
});
