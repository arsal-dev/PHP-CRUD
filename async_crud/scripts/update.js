function updateData(element) {
    let tr = element.parentElement.parentElement.children;

    let id = tr[0].innerHTML;
    let name = tr[1].innerHTML;
    let email = tr[2].innerHTML;
    let phone = tr[3].innerHTML;
    let address = tr[4].innerHTML;

    document.querySelector('#up_id').value = id;
    document.querySelector('#up_name').value = name;
    document.querySelector('#up_email').value = email;
    document.querySelector('#up_phone').value = phone;
    document.querySelector('#up_address').value = address;

    document.querySelector('#update_form').addEventListener('submit', async function (e) {
        e.preventDefault();

        let updated_name = document.querySelector('#up_name').value;
        let updated_email = document.querySelector('#up_email').value;
        let updated_phone = document.querySelector('#up_phone').value;
        let updated_address = document.querySelector('#up_address').value;

        let obj = { id, updated_name, updated_email, updated_phone, updated_address };

        let res = await fetch('./apis/update.php', {
            method: 'POST',
            body: JSON.stringify(obj)
        });

        res = await res.json();
        if (res.status == 200) {
            document.querySelector('#success-message').innerHTML = res.result;
            document.querySelector('#success-alert').classList.remove('d-none');
            get();
        }
    })
}