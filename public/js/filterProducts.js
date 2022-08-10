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

    let rows = '';
    let accorditionContainer = document.getElementById('accord');
    accorditionContainer.innerHTML = '';
    data.forEach((element, index) => {
        let item = `<div class="tab w-full overflow-hidden border-t">
                        <input class="absolute opacity-0" id="tab-multi-${index}" type="checkbox" name="tabs">
                        <label class="block px-5 py-3 leading-normal cursor-pointer" for="tab-multi-${index}">#${index}</label>
                        <div id="content-here" class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                            <div id="products-table" class="w-full overflow-hidden rounded-lg shadow-xs">
                                <div class="w-full overflow-x-auto">
                                     <table class="w-full whitespace-no-wrap">
                                         <thead>
                                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                 <th class="px-4 py-3">Title</th>
                                                 <th class="px-4 py-3">Price</th>
                                                 <th class="px-4 py-3">Manufacturer</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-${index}" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>`
        accorditionContainer.insertAdjacentHTML("beforeend", item);
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
        })
        document.getElementById(`tbody-${index}`).innerHTML = rows;
        rows = ''
        document.getElementById('filteredIds').value = ids;
        // console.log(document.getElementById('filteredIds').value)
    })

}
