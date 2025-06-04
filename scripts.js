
    function refreshVehicles() {
        fetch('get_vehicles.php')
        .then(Response =>{
            if(!Response.ok){
                throw new Error('Błąd pobierania danych');
            }
            return Response.text();
        })
        .then(data => {
            console.log('Pomyslnie pobrano dane');
        })
        .catch(Error =>{
            console.error('Blad podczas pobierania danych');
        })
    }

    refreshVehicles();
    setInterval(refreshVehicles, 60000);
