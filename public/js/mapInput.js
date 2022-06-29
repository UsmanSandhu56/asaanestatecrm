function initialize() {
    let input = document.getElementById('city');
    google.maps.event.addDomListener(input, 'keydown', function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
        }
    });
    let cityOptions = {
        types: ['(cities)'],
        fields: ["geometry", "name"],
        componentRestrictions: {
            country: "pk"
        },
    };
    let city = new google.maps.places.Autocomplete(input, cityOptions);
    let defaultBounds, sLat, sLng, nLat, nLng

    city.addListener('place_changed', function () {
        $('#city').val(city.getPlace().name);
        let place = city.getPlace();
        nLat = place.geometry['viewport'].getNorthEast().lat();
        nLng = place.geometry['viewport'].getNorthEast().lng();
        sLat = place.geometry['viewport'].getSouthWest().lat();
        sLng = place.geometry['viewport'].getSouthWest().lng();
        defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(sLat, sLng),
            new google.maps.LatLng(nLat, nLng));
        let options = {
            bounds: defaultBounds,
            strictBounds: true,
        };
        let input = document.getElementById('autocomplete');
        google.maps.event.addDomListener(input, 'keydown', function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
            }
        });
        let autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            let place = autocomplete.getPlace();
            for (const component of place.address_components) {
                const componentType = component.types[0];
                switch (componentType) {
                    case "locality":
                        document.querySelector("#locality").value = component.long_name;
                        break;

                    case "sublocality_level_1":
                        document.querySelector("#sublocality_level_1").value = component.long_name;
                        break;

                    case "sublocality_level_2":
                        document.querySelector("#sublocality_level_2").value = component.long_name;
                        break;

                    case "sublocality_level_3":
                        document.querySelector("#sublocality_level_3").value = component.long_name;
                        break;
                }
            }

            $('#latitude').val(place.geometry['location'].lat());
            let latitude = document.getElementById('latitude');
            latitude.dispatchEvent(new Event('input'));

            $('#longitude').val(place.geometry['location'].lng());
            let longitude = document.getElementById('longitude');
            longitude.dispatchEvent(new Event('input'));

            let sublocality_level_1 = document.getElementById('sublocality_level_1');
            sublocality_level_1.dispatchEvent(new Event('input'));

            let sublocality_level_2 = document.getElementById('sublocality_level_2');
            sublocality_level_2.dispatchEvent(new Event('input'));

            let sublocality_level_3 = document.getElementById('sublocality_level_3');
            sublocality_level_3.dispatchEvent(new Event('input'));

            let locality = document.getElementById('locality');
            locality.dispatchEvent(new Event('input'));
        });
    });
}
