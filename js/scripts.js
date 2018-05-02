let fetchData;
(fetchData = () => {
    $.ajax({
        url: 'list.php',
        method: 'get',
        success: (response) => {
            $("#results").empty();
            response.data.forEach(item => {
                const licence = item.licence == 1 ? 'van' : 'nincs';
                let row = `<tr><td>${item.id}</td><td>${item.name}</td><td>${item.email}</td><td>${item.phonenumber}</td>`;
                row += `<td>${item.birthdate}</td><td>${licence}</td><td>${item.hobby}</td>`;
                row += `<td><a href="index.php?id=${item.id}">szerkesztés</a></td></tr>`
                $('#results').append(row);
            });
        },
        error: (err) => {
            console.log(err);
            alert(JSON.stringify(err.responseJSON.error));
        }
    })
})();

$("#infoForm").on('submit', (e) => {
    e.preventDefault();

    const data = {
        name: $('#name').val(),
        email: $('#email').val(),
        phoneNumber: $('#phoneNumber').val(),
        birthDate: $('#birthDate').val(),
        licence: $('input[name="licence"]:checked').val(),
        hobby: []
    };

    const id = $('#id').val();

    if (id !== ''){
        data.id = id;
    }

    $(".hobby").each((index, item) => {
        if (item.checked) data.hobby.push(item.value);
    });

    $.ajax({
        url: 'submit.php',
        method: id === '' ? 'post' : 'put',
        data,
        success: (response) => {
            fetchData();
            alert(response.message);
        },
        error: (err) => {
            alert(JSON.stringify(err.responseJSON.error));
        }
    });
});
