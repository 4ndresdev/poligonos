<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poligonos</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div id="map"></div>

    <div class="search">
        <input id="search-input" type="text" placeholder="Introduzca su dirección">
        <button id="buscar">
            Buscar
        </button>

    </div>


    <script src="jquery.js"></script>
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3fLQa6ezPBVVuyplqfUXE8KsrH4GfOHQ&callback=initMap">
    </script>
    <script>
        let map;
        var markers = [];
        var poligonos = [];

        //Plantilla del loading
        var loading = `
        <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        `;



        function initMap() {


            map = new google.maps.Map(document.getElementById("map"), { //Carga el mapa
                center: {
                    lat: 20.3698461,
                    lng: -102.7867129
                },
                zoom: 16,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: true,
                rotateControl: false,
                fullscreenControl: false
            });


            const geocoder = new google.maps.Geocoder();

            document.getElementById("buscar").addEventListener("click", function() { //Cuando le de clic en buscar

                if ($('#search-input').val() != '') { //verifica si el campo no es vacio

                    let address = document.getElementById('search-input').value; //Toma la dirección

                    $('#buscar').html(loading); //Pone en el boton el loading
                    $('#buscar').prop('disabled', true); //Deshabilita el boton
                    geocodeAddress(geocoder, map, address); // Ubica en base a la direccion las coordenadas en el mapa
                } else {
                    alert('Introduzca una dirección');
                }


            });

            function geocodeAddress(geocoder, resultsMap, address) {

                geocoder.geocode({
                    address: address
                }, (results, status) => {
                    if (status === "OK") {

                        resultsMap.setCenter(results[0].geometry.location); //Centra el mapa en las coordenadas obtenidas

                        algoritmo(results[0].geometry.location); //Inicia el proceso de busqueda secuencial

                    } else {
                        alert("No se encontró la dirección especificada " + status);
                        $('#buscar').prop('disabled', false); //Habilita el boton
                        $('#buscar').text('Buscar'); //Quita el loading
                    }
                });
            }



            function algoritmo(coordenadas) {


                if (markers.length > 0) { //Si existen marcadores, los elimina
                    cleanMarkers();
                }

                $.each(poligonos, (function(j, items) { //Borra todos los poligonos antes de crear uno nuevo
                    poligonos[j].setMap(null);
                }));

                $.ajax({
                    type: 'POST',
                    url: 'Controlador.php',
                    dataType: 'json',
                    success: function(result) {


                        $.each(result, function(i, item) {

                            var figura = getCoords(item.coordenadas); //Obtiene los puntos de coordenadas de la base de datos

                            var poligono = new google.maps.Polygon({ //Crea el poligono en base a la figura obtenida
                                path: figura,
                                strokeColor: item.color,
                                strokeOpacity: 1,
                                strokeWeight: 2,
                                fillColor: item.color,
                                fillOpacity: 0.3,
                            });

                            poligonos.push(poligono);


                            //Crea una ventana con información de la clave 
                            const leyenda = ` 
                            <div id="content">
                                <div id="siteNotice">
                                </div>
                                <h3 id="firstHeading" class="firstHeading">Clave</h3>
                                <div id="bodyContent">
                                <p>Zona: ${item.zona}</p>                                
                                <p>clave: ${item.clave}</p>                                
                                </div>
                            </div>
                        `;


                            const infowindow = new google.maps.InfoWindow({ //Agrega la leyenda al mapa
                                content: leyenda,
                            });

                            setTimeout(() => {
                                if (google.maps.geometry.poly.containsLocation(coordenadas, poligonos[i])) { //verifica si la direccion esta dentro de un poligono determinado

                                    var marker = new google.maps.Marker({ //agrega el marcador
                                        map: map,
                                        position: coordenadas,
                                        draggable: true
                                    });

                                    markers.push(marker);

                                    marker.addListener("dragend", () => { //Evento del marcador                
                                        $('#buscar').html(loading); //Pone en el boton el loading
                                        $('#buscar').prop('disabled', true); //Deshabilita el boton
                                        map.setCenter(marker.getPosition());
                                        algoritmo(marker.getPosition());

                                    });

                                    poligono.setMap(map);
                                    infowindow.open(map, marker); //Carga la leyenda en el marcador

                                    info(item.clave); //Realizan las operaciones correspondientes en base al resultado                                   

                                }

                            }, 1000);

                        });

                    },
                    error: function(error) {
                        console.log('Error al tratar de recuperar los poligonos');
                    }

                });


                $('#buscar').prop('disabled', false);
                $('#buscar').text('Buscar');

            }

            function getCoords(string) { //convierte las coordenadas string en arreglo de numeros
                var coords = [];
                string.match(/[\d.]+/g).map(Number).forEach(function(a, i) {
                    if (i % 2) {
                        coords[coords.length - 1].lng = -a;
                    } else {
                        coords.push({
                            lat: a
                        }, );
                    }
                });
                return coords;
            }

            function cleanMarkers() { //Limpia los marcadores
                for (let index = 0; index < markers.length; index++) {
                    markers[index].setMap(null);
                }

                markers = [];
            }

            function info(clave) { //verifica si entra o no en algun poligono y en cual 
                if (markers.length > 0) {

                    /**

                    Aqui Se hace la peticion para verificar si el giro aplica o no

                    */

                } else {
                    //Las coordenadas no coinciden con algun poligono registrado
                }
            }


        }
    </script>
</body>

</html>