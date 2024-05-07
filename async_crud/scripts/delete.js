function deleteData(element) {
    let id = element.parentElement.parentElement.children[0].innerHTML;

    let deleteModalBtn = document.querySelector('#deleteModalBtn');

    deleteModalBtn.setAttribute('href', `./apis/delete.php?id=${id}`);
}