function deleteData(element) {
    let id = element.parentElement.parentElement.children[0].innerHTML;

    let deleteModalBtn = document.querySelector('#deleteModalBtn');

    // deleteModalBtn.setAttribute('href', `./apis/delete.php?id=${id}`);

    deleteModalBtn.addEventListener('click', async function () {

        let res = await fetch(`apis/delete.php?id=${id}`);

        // let json_response = await res.text();
        // let js_obj = JSON.parse(json_response);

        let js_obj = await res.json();

        if (js_obj.status == 200) {
            get();
            document.querySelector('#success-message').innerHTML = js_obj.result;
            document.querySelector('#success-alert').classList.remove('d-none');
        }

    });

}