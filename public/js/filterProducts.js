var filteredArray = [];
var ids = ''
const fd = (e, csrf_token) => {
    e.preventDefault()
    let category = [...document.getElementById("select-category").options].filter(option => option.selected).map(option => option.value)
    let products = [...document.getElementById("select-product").options].filter(option => option.selected).map(option => option.value)
    let price_from = document.getElementById("price_from").value;
    let price_to = document.getElementById("price_to").value;
    let manufacturingDateStart = document.getElementById("manufacturingDateStart").value;
    let manufacturingDateEnd = document.getElementById("manufacturingDateEnd").value;
    const data = {
        category,
        products,
        price_from,
        price_to,
        manufacturingDateStart,
        manufacturingDateEnd,
    };


    fetch('/dashboard/promotion/filter-products', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrf_token,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    }).then((response) => response.json())
        .then((data) => {
            console.log('Success:', data);
            filteredArray.push(data);
            console.log(filteredArray);
            fillTable(filteredArray);
        })
        .catch((error) => {
            console.error('Error:', error);
        });

}
const fillTable = (data) => {
    if (data.length > 0) {
        document.getElementById('products-table').classList.remove('hidden')
    }

    let rows = '';
    acco = ''
    data.forEach((element,index) => {

// inner = document.getElementById('accordionExample').innerHTML
//         inner +=
        element.forEach(e => {
            ids += e.id + ' '
            rows = rows +
                `<tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                    <!-- Avatar with inset shadow -->
                    <div class="relative hidden w-10 h-8 mr-3 rounded-full md:block">
                    <img class="object-cover w-full h-full " src="/public/img/${e.images[0].file_name} " alt="" loading="lazy">
                      <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                <div>
                <p class="font-semibold">${e.product_name}</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">${e.product_name}</p>
        </div>
    </div>
</td>
<td class="px-4 py-3 text-xs">
     <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 rounded-full">
${e.total_price}
            </span>
       </td>
       <td class="px-4 py-3 text-sm">
${e.manufacturer.manufacturer_name}
            </td>
        </tr>`;
            document.getElementById('tbody').innerHTML = rows;
        })
        document.getElementById('filteredIds').value = ids;
        console.log(document.getElementById('filteredIds').value)
    })

}
