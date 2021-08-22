const createMap = ({ lat, lng }) => {
    return new google.maps.Map(document.getElementById("map"), {
        center: { lat, lng },
        zoom: 15,
    });
};

const createHospitalMarker = (map) => {
    const hospitalMessage = `
        <div>
            <h3>Hospital Regional Alto Vale - Rio do Sul</h3>
        </div>
    `;

    const infowindow = new google.maps.InfoWindow({
        content: hospitalMessage,
    });

    const hospitalMarker = new google.maps.Marker({
        map,
        position: {
            lat: -27.21916427252266,
            lng: -49.64350801292755,
        },
    });

    hospitalMarker.addListener("click", () => {
        infowindow.open({
            anchor: hospitalMarker,
            map,
            shouldFocus: false,
        });
    });

    return hospitalMarker;
};

const createMarker = ({ map, position }) => {
    const userMessage = `
        <div>
            <h3>Sua localização atual</h3>
        </div>
    `;

    const infowindow = new google.maps.InfoWindow({
        content: userMessage,
    });

    const marker = new google.maps.Marker({ map, position });

    marker.addListener("click", () => {
        infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
        });
    });

    return marker;
};

const trackLocation = ({ onSuccess, onError = () => {} }) => {
    if ("geolocation" in navigator === false) {
        return onError(new Error("Erro na API de Geolocation"));
    }

    return navigator.geolocation.watchPosition(onSuccess, onError, {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
    });
};

const getPositionErrorMessage = (code) => {
    switch (code) {
        case 1:
            return "Permissão negada.";
        case 2:
            return "Localização inválida.";
        case 3:
            return "Esgotou o tempo.";
    }
};

function init() {
    const initialPosition = { lat: 59.32, lng: 17.84 };

    const map = createMap(initialPosition);
    const marker = createMarker({ map, position: initialPosition });
    createHospitalMarker(map);

    trackLocation({
        onSuccess: ({ coords: { latitude: lat, longitude: lng } }) => {
            marker.setPosition({ lat, lng });
            map.panTo({ lat, lng });

            console.log(`Lat: ${lat.toFixed(5)} Lng: ${lng.toFixed(5)}`);
        },
        onError: console.error,
    });
}
