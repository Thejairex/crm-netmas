// codigo para postman pre-request script

// obtener el csrf token del body
pm.test("Reference to jQuery", function () {
    var csrf_token = pm.response.text().match(/<meta name="csrf-token" content="([^"]+)"/)[1];
    pm.environment.set("csrf_token", csrf_token);
});

// ir al login postman
pm.sendRequest({
    url: "http://localhost:3000/login",
    method: "POST",
    header: {
        "Content-Type": "application/json",
        "X-CSRF-Token": "{{csrf_token}}"
    },
    body: {
        "email": "XxR2b@example.com",
        "password": "123456",
        "_token": "{{csrf_token}}"
    }
});

// verificar si cambio la url
pm.test("Status code is 200", function () {
    pm.response.to.have.status(200);
});