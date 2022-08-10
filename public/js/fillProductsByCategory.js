const fillProducts = (csrf_token) => {
    let category = [...document.getElementById("select-category").options].filter(option => option.selected).map(option => option.value)
    const data = {
        category
    }
    fetch('/dashboard/products-by-category', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf_token,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    }).then((response) => response.json())
        .then((data) => {
            pds.clearOptions();
            data.forEach(element => {
                pds.addOption({
                    id: element.id,
                    title: element.product_name,
                });
            });
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}
