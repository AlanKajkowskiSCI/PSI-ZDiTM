
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

    function refreshChanges() {
        fetch('get_zmiany.php')
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
    refreshChanges();
    refreshVehicles();
    setInterval(refreshVehicles, 60000);
    setInterval(refreshChanges, 60000);


    