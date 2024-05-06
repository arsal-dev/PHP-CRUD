let createForm = document.getElementById('create_form');

createForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    let name = document.querySelector('#name').value;
    let email = document.querySelector('#email').value;
    let phone = document.querySelector('#phone').value;
    let address = document.querySelector('#address').value;

    let obj = { name, email, phone, address };

    let res = await fetch('./apis/create.php', {
        'method': 'POST',
        'body': JSON.stringify(obj)
    });

    res = await res.json();

    if (res.status == 200) {
        document.querySelector('#success-alert').classList.remove('d-none');
    }
});