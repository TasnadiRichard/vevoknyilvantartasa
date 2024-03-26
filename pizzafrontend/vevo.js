document.addEventListener('DOMContentLoaded', function() {
    const insertButton = document.getElementById("create");
    const readButton = document.getElementById("read");
    const updateButton = document.getElementById("update");
    const deleteButton = document.getElementById("delete");
    const vevoForm = document.getElementById("vevoForm");
    const vevokDiv = document.getElementById("vevolista");
    insertButton.addEventListener('click', async function() {
        let baseUrl = "http://localhost/pizzabackend/index.php?vevo";

        const formData = new FormData(document.getElementById("vevoForm"));
        let options = {
            method: 'POST',
            mode: 'no-cors',
            body: formData
        };
        let response = await fetch(baseUrl, options);
        if (response.ok) {
            console.log("Sikeres adatfelvitel");
        } else {
            console.error("Hiba a szerver válaszában");
        }
    });
    readButton.addEventListener('click', async function() {
        vevoForm.classList.add('d-none');
        vevokDiv.classList.remove('d-none');
        let baseUrl = "http://localhost/pizzabackend/index.php?vevo";
        let options = {
            method: "GET",
            mode: "cors"
        };
        let response = await fetch(baseUrl, options);
        if (response.ok) {
            let data = await response.json();
            vevokListazasa(data);
        } else {
            console.error("Hiba a szerver válaszában");
        };
    });

    function vevokListazasa(vevok) {
        let vevokDiv = document.getElementById("vevolista");
        let tablazat = vevoFejlec();
        for (let vevo of vevok) {
            tablazat += vevoSor(vevo);
        }
        vevokDiv.innerHTML = tablazat + '<tbody></table>';

    }
    function vevoSor(vevo) {
        let sor = `<tr>
            <td>${vevo.vazon}</td>
            <td>${vevo.vnev}</td>
            <td>${vevo.vcim}</td>
            <td><button class="btn btn-outline-dark" onclick="adatBetoltes(${vevo.vazon})"><i class="fa-regular fa-hand-point-left"></i></button></td>
        </tr>`;
        return sor;
    }
    function vevoFejlec() {
        let fejlec = `<table class="table table-striped">
        <thead>
            <tr>
                <th>Azonosító</th>
                <th>Név</th>
                <th>Cím</th>
            </tr>
        </thead>
        <tbody>`;
        return fejlec;
    }
});