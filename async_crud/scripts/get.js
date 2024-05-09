
get();
async function get() {
    let getTableBody = document.querySelector('#get-table-body');
    getTableBody.innerHTML = '';
    let res = await fetch('./apis/get.php');
    res = await res.json();

    for (let i = 0; i < res.length; i++) {
        let tr = document.createElement('tr');

        updateTd = document.createElement('td');
        updateBtn = document.createElement('button');
        updateBtn.innerHTML = 'update';
        updateBtn.classList.add('btn');
        updateBtn.classList.add('btn-primary');
        updateBtn.setAttribute('data-bs-toggle', 'modal');
        updateBtn.setAttribute('data-bs-target', '#updateModal');
        updateBtn.setAttribute('onClick', 'updateData(this)');
        updateTd.append(updateBtn);

        deleteTd = document.createElement('td');
        deleteBtn = document.createElement('button');
        deleteBtn.innerHTML = 'delete';
        deleteBtn.setAttribute('data-bs-toggle', 'modal');
        deleteBtn.setAttribute('data-bs-target', '#deleteModal');
        deleteBtn.setAttribute('onClick', 'deleteData(this)');
        deleteBtn.classList.add('btn');
        deleteBtn.classList.add('btn-danger');
        deleteTd.append(deleteBtn);

        for (let j = 0; j < res[i].length; j++) {
            let td = document.createElement('td');
            td.innerHTML = res[i][j];
            tr.append(td, updateTd, deleteTd);
        }

        getTableBody.append(tr);
    }
}